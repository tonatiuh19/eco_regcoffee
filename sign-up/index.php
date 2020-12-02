<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/style.css">
<link href="../../css/fontawesome/css/all.css" rel="stylesheet">
<?php
session_start();
require_once('../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mail_i = test_input($_POST["email"]);
	$username = test_input($_POST["usernametxt"]);
    $pwd = test_input($_POST["password"]);
    $today = date("Y-m-d H:i:s");

    $sql = "SELECT email FROM users WHERE email='".$mail_i."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center">
          
              <h4 class="modal-title w-100" id="exampleModalLongTitle"><i class="far fa-paper-plane fa-2x"></i></h4>
              <h4>Hemos enviado instrucciones a tu correo: <span class="btn btn-link">'.$mail_i.'</span></h4>
              
              <a href="../" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Iniciar sesion</a>
            
            </div>
          </div>
        </div>
      </div>';
    } else {
        $sql = "INSERT INTO users (user_name, email, pwd, date)
        VALUES ('$username', '$mail_i', '$pwd', '$today')";
        
        if ($conn->query($sql) === TRUE) {

            $sql3 = "SELECT id_user, user_name FROM users WHERE email='".$mail_i."'";
            $result3 = $conn->query($sql3);

            if ($result3->num_rows > 0) {
            // output data of each row
                while($row3 = $result3->fetch_assoc()) {
                    $_SESSION["user_param"] = $row3["id_user"];
                    $_SESSION["uname"] = $row3["user_name"];

                    $folder_path = "../".$username."/";
                    if (!file_exists($folder_path)) {
                        if(mkdir($folder_path, 0777, true)){
                            
                            if(copy("../template/index.php", "../".$username."/index.php")){
                                $idUser = $_SESSION["user_param"];
                                $sqli = "INSERT INTO users_notification (id_user, new_supporter, new_coffe, date)
                                VALUES ('$idUser', '1', '1', '$today')";

                                if ($conn->query($sqli) === TRUE) {
                                    $sql2 = "INSERT INTO `extras` (`title`, `id_user`, `description`, `confirmation`, `price`, `date`, `active`) VALUES ('Coffee', '$idUser', '¡Me estas invitando un cafe!', 'Te agradezco de todo corazon. Tu apoyo me permite seguir motivado :)', '45', '$today', '2');";

                                    if (mysqli_query($conn, $sql2)) {
                                        echo ("<SCRIPT LANGUAGE='JavaScript'>
                                        window.location.href='../';
                                        </SCRIPT>");
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }
                                   
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                                
                            }else{
                                echo "Houston tenemos problemas";
                            }
                        }else{
                            
                        }
                    }else{
                        echo "Houston tenemos problemas";
                    }
                }
            } else {
                echo "0 results";
            }
            
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();

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
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $('#exampleModalCenter').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>