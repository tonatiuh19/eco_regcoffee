<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/style.css">
<link href="../../css/fontawesome/css/all.css" rel="stylesheet">
<meta http-equiv="Content-Type"
    content="text/html; charset=utf-8"
    />
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = test_input($_POST["email_o"]);
	$todayVisit = date("Y-m-d H:i:s");
	
	$sql = "SELECT email, user_name, id_user, active FROM users WHERE email='$email'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
		while($row = $result->fetch_assoc()) {	
            $type = $row["active"];
            $idUser = $row["id_user"];
            $uname = $row["user_name"];
        }
        $digits = 4;
        $code = rand(pow(10, $digits-1), pow(10, $digits)-1);
        $sql = "INSERT INTO users_code (code, id_user, date)
        VALUES ('$code', '$idUser', '$todayVisit')";

        if ($conn->query($sql) === TRUE) {
            $sql2 = "SELECT t.code FROM users_code as t INNER JOIN (SELECT id_user,MAX(date) as max_date FROM users_code WHERE id_user=".$idUser." GROUP BY id_user) as a ON a.max_date = t.date";
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
            // output data of each row
                while($row2 = $result2->fetch_assoc()) {
                    $codeMail = $row2["code"];
                }
                
                if(sendMailCode($codeMail, $email, $uname)){

                }else{
                    echo "Houston tenemos problemas";
                }
                echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                
                        <form action="../passwordReset/" method="post" id="formDigit">
                            <div class="form-group text-center">
                                <span>Revisa tu correo</span><br>
                                <label for="exampleInputPassword1">¿Cual es el codigo que enviamos?</label>
                                <input type="number" name="codeTo" class="form-control" id="exampleInputPassword1" placeholder="XXXX" required>
                                <input type="hidden" name="idUser" value="'.$idUser.'">
                                <input type="hidden" name="typee" value="1">
                            </div>
                            <a href="../" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                            <button type="submit" class="btn btn-primary">Continuar <i class="fas fa-arrow-circle-right"></i></button>
                        </form>
                        <div class="form-group text-center">
                            <form action="../olvidemicontrasena/" method="post">
                                <input type="hidden" name="email_o" value="'.$email.'">
                                <button type="submit" id="regenerateCode" class="btn btn-link btn-sm">Generar de nuevo <i class="fas fa-redo"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>';
            } else {
                echo "0 results";
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
	} else{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Este correo no existe dentro de nuestros registros.')
			window.location.href='../';
			</SCRIPT>");
	}
}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.location.href='../';
		</SCRIPT>");
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function sendMailCode($code, $email, $uname){
    
    require_once('../admin/mailer/vendor/autoload.php');
    $mail = new PHPMailer(true);

    try {
        require_once('../admin/serversettingsPhpmailer.php');
        $mail->setLanguage('es', '../admin/mailer/vendor/phpmailer/phpmailer/language');
        $mail->addAddress($email, $uname);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Reinicia tu contraseña | Regalameuncafe';
        $mail->Body    = 'Hola, <p>El codigo para reiniciar tu contraseña es: <b>'.$code.'</b></p> <br>Equipo Regalameuncafe.<br>ayuda@regalameuncafe.com';
        $mail->AltBody = 'Hola, <p>El codigo para reiniciar tu contraseña es: <b>'.$code.'</b></p> <br>Equipo Regalameuncafe.<br>ayuda@regalameuncafe.com';

        $mail->send();        
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}


?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $('#exampleModalCenter').modal({
        backdrop: 'static',
        keyboard: false
    });
   
   $("#regenerateCode").click( function() {
      alert("Nuevo codigo enviado");
   });
</script>