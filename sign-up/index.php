<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/style.css">
<link href="../../css/fontawesome/css/all.css" rel="stylesheet">
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

            $sql3 = "SELECT id_user, user_name, active FROM users WHERE email='".$mail_i."'";
            $result3 = $conn->query($sql3);

            if ($result3->num_rows > 0) {
            // output data of each row
                while($row3 = $result3->fetch_assoc()) {
                    $_SESSION["user_param"] = $row3["id_user"];
                    $_SESSION["uname"] = $row3["user_name"];
                    $_SESSION["utype"] = $row3["active"];

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
                                        if(sendMailWelcome($mail_i, $username)){
                                            echo ("<SCRIPT LANGUAGE='JavaScript'>
                                            window.location.href='../';
                                            </SCRIPT>");
                                        }else{
                                            echo "Houston tenemos problemas";
                                        }
                                        
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

function sendMailWelcome($email, $uname){
    
    require_once('../admin/mailer/vendor/autoload.php');
    $mail = new PHPMailer(true);

    try {
        require_once('../admin/serversettingsPhpmailer.php');
        $mail->setLanguage('es', '../admin/mailer/vendor/phpmailer/phpmailer/language');
        $mail->addAddress($email, $uname);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Reinicia tu contraseña | Regalameuncafe';
        $mail->Body    = '<html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <meta name="viewport" content="width=device-width, initial-scale=1" /> <title>Regalame un Cafe</title> <style type="text/css"> img {max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; } a {border: 0; outline: none; } a img {border: none; } td, h1, h2, h3  {font-family: Helvetica, Arial, sans-serif; font-weight: 400; } td {font-size: 13px; line-height: 150%; text-align: left; } body {-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 100%; height: 100%; color: #37302d; background: #ffffff; } table {border-collapse: collapse !important; } h1, h2, h3 {padding: 0; margin: 0; color: #444444; font-weight: 400; line-height: 110%; } h1 {font-size: 35px; } h2 {font-size: 30px; } h3 {font-size: 24px; } h4 {font-size: 18px; font-weight: normal; } .important-font {color: #21BEB4; font-weight: bold; } .hide {display: none !important; } .force-full-width {width: 100% !important; } </style> <style type="text/css" media="screen"> @media screen {@import url(http://fonts.googleapis.com/css?family=Open+Sans:400); td, h1, h2, h3 {font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif !important; } } </style> <style type="text/css" media="only screen and (max-width: 600px)"> @media only screen and (max-width: 600px) {table[class="w320"] {width: 320px !important; } table[class="w300"] {width: 300px !important; } table[class="w290"] {width: 290px !important; } td[class="w320"] {width: 320px !important; } td[class~="mobile-padding"] {padding-left: 14px !important; padding-right: 14px !important; } td[class*="mobile-padding-left"] {padding-left: 14px !important; } td[class*="mobile-padding-right"] {padding-right: 14px !important; } td[class*="mobile-block"] {display: block !important; width: 100% !important; text-align: left !important; padding-left: 0 !important; padding-right: 0 !important; padding-bottom: 15px !important; } td[class*="mobile-no-padding-bottom"] {padding-bottom: 0 !important; } td[class~="mobile-center"] {text-align: center !important; } table[class*="mobile-center-block"] {float: none !important; margin: 0 auto !important; } *[class*="mobile-hide"] {display: none !important; width: 0 !important; height: 0 !important; line-height: 0 !important; font-size: 0 !important; } td[class*="mobile-border"] {border: 0 !important; } } </style> </head> <body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff"> <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%"> <tr> <td align="center" valign="top" bgcolor="#ffffff"  width="100%"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="background:#1f1f1f" width="100%"> <center> <table cellspacing="0" cellpadding="0" width="600" class="w320"> <tr> <td valign="top" class="mobile-block mobile-no-padding-bottom mobile-center" width="270" style="background:#1f1f1f;padding:10px 10px 10px 20px;"> <a href="#" style="text-decoration:none;"> <img src="https://regalameuncafe.com/images/logo_un.png" width="142" height="30" alt="Your Logo"/> </a> </td> <td valign="top" class="mobile-block mobile-center" width="270" style="background:#1f1f1f;padding:10px 15px 10px 10px"> </td> </tr> </table> </center> </td> </tr> <tr> <td style="border-bottom:1px solid #e7e7e7;"> <center> <table cellpadding="0" cellspacing="0" width="600" class="w320"> <tr> <td align="left" class="mobile-padding" style="padding:20px"> <br class="mobile-hide" /> <h2>Bienvenido</h2><br> <p>¡Hola '.$uname.'!</p> Te felicitamos por darle a tu audiencia lo que realmente se merece y necesita. Si necesitas en algún momento alguna ayuda, puedes responder este correo o dar click en el enlace de abajo de soporte.<br> <br> <p>Equipo Regalameuncafe<br>ayuda@regalameuncafe.com</p> <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff"> <tr> <td width="281" style="background-color:#ffffff; font-size:0; line-height:0;">&nbsp;</td> </tr> </table> </td> <td class="mobile-hide" style="padding-top:20px;padding-bottom:0; vertical-align:bottom;" valign="bottom"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td align="right" valign="bottom" style="padding-bottom:0; vertical-align:bottom;"> <img  style="vertical-align:bottom;" src="https://regalameuncafe.com/images/cheers_mail.png"  width="174" height="294" /> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td valign="top" style="background-color:#f8f8f8;border-bottom:1px solid #e7e7e7;"> <center> <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;"> <tr> <td valign="top" class="mobile-padding" style="padding:20px;"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-right:20px"> </td> <td> </td> </tr> <tr> <td style="padding-top:5px; padding-right:20px; border-top:1px solid #E7E7E7; vertical-align:top; "> Tambien puedes seguir apoyando a otros creadores ;) </td> <td style="padding-top:5px; border-top:1px solid #E7E7E7;"> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td style="background-color:#1f1f1f;"> <center> <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;color:#ffffff" bgcolor="#1f1f1f" > <tr> <td align="right" valign="middle" class="mobile-padding" style="font-size:12px;padding:20px; background-color:#1f1f1f; color:#ffffff; text-align:left; "> <a style="color:#ffffff;" href="mailto:ayuda@regalameuncafe.com?Subject=Necesito%20ayuda">Soporte</a>&nbsp;&nbsp;|&nbsp;&nbsp; </td> </tr> </table> </center> </td> </tr> </table> </td> </tr> </table> </body> </html>';
        $mail->AltBody = 'Bienvenido '.$uname.', <p>Te damos un reconocimiento por darle a tu audiencia lo que se merece y se necesita.</p> <br>Equipo Regalameuncafe.<br>ayuda@regalameuncafe.com';

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
</script>