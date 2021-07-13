<link rel="stylesheet" href="../../css/bootstrap.css">
<link rel="stylesheet" href="../../css/style.css">
<link href="../../css/fontawesome/css/all.css" rel="stylesheet">
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//session_start();
require_once('../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $status = test_input($_POST["stat"]);
  $uname = test_input($_POST["uname"]);
  $email = test_input($_POST["email"]);
  $description = test_input($_POST["description"]);
  $noteFan = test_input($_POST["noteFan"]);
  $isPublic = test_input($_POST["isPublic"]);
  $today = date("Y-m-d H:i:s");
  $idExtra = test_input($_POST["id-extra"]);
  $confirmationM = test_input($_POST["confirmationM"]);

  $whatIWant = substr($description, strpos($description, "|") + 1);

  $sql = "SELECT id_user FROM users WHERE user_name='" . $uname . "'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $idUser = $row["id_user"];
    }
  }
  if ($status == "1") {
    $uname = test_input($_POST["uname"]);
    $idPay = test_input($_POST["idPay"]);
    $typeB = test_input($_POST["typeB"]);
    $brand = test_input($_POST["brand"]);
    $cardNo = test_input($_POST["cardNo"]);
    $bank = test_input($_POST["bank"]);
    $satusB = test_input($_POST["status"]);
    $date = test_input($_POST["date"]);
    $amount = test_input($_POST["amount"]);
    $amountF = test_input($_POST["amountF"]);
    $amountT = test_input($_POST["amountT"]);
    $questAnswer = test_input($_POST["questAnswer"]);
    $emailHost = test_input($_POST["emailHost"]);

    $sqli = "INSERT INTO payments (id_user, id_openpay, type, brand, card_number, bank_name, status, date, amount, amount_fee, amount_tax, description, email_user, note_fan, isPublic_note_fan, id_extra, question_answer)
      VALUES ('$idUser', '$idPay', '$typeB', '$brand', '$cardNo', '$bank', '$satusB', '$date', '$amount', '$amountF', '$amountT', '$description', '$email', '$noteFan', '$isPublic', '$idExtra', '$questAnswer')";

    if ($conn->query($sqli) === TRUE) {

      $sql1 = "SELECT email FROM users WHERE email='" . $email . "'";
      $result1 = $conn->query($sql1);

      if ($result1->num_rows > 0) {
        // output data of each row

        if (sendMailGracias($email, $uname, $confirmationM, $amount, $whatIWant)) {
          if(sendMailHostCoffee($emailHost, $uname)){
            echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="container">
                    <div class="row text-center">
                      <h4 class="modal-title w-100" id="exampleModalLongTitle">
                        <div class="col-12 mb-2">
                          <i class="fas fa-user-alt"></i>
                        </div>
                        <div class="col-12 mb-2">
                          <span class="bg-dark text-white p-1 rounded small">' . $uname . '</span>
                        </div>
                        <div class="col-12 mb-2">
                          <b>¡Gracias totales!</b>
                        </div>
                      </h4>
          
                    </div>
                  </div>
                  <div class="row text-center">
                    <div class="col-12 mb-2">
                      Revisa tu correo donde encontraras tu recibo de pago y un mensaje especial.
                    </div>
                  </div>
                  <div class="row text-center">
                    <div class="col-12">
                      <a href="../' . $uname . '" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>';
          }else{
            echo 'Houston tenemos problemas';
          }
        } else {
          echo 'Houston tenemos problemas';
        }
      } else {
        $sql2 = "INSERT INTO users (user_name, email, pwd, date, active, about)
          VALUES ('', '$email', '/%Chivas%%%%%%(93)123%/', '$today', '2', '¡Oye!, acabo de crear una super página aquí. ¡Ahora puedes invitarme a un café!')";

        if ($conn->query($sql2) === TRUE) {
          if (sendMailGracias($email, $uname, $confirmationM, $amount, $whatIWant)) {
            if(sendMailHostCoffee($emailHost, $uname)){
              echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="container">
                      <div class="row text-center">
                        <h4 class="modal-title w-100" id="exampleModalLongTitle">
                          <div class="col-12 mb-2">
                            <i class="fas fa-user-alt"></i>
                          </div>
                          <div class="col-12 mb-2">
                            <span class="bg-dark text-white p-1 rounded small">' . $uname . '</span>
                          </div>
                          <div class="col-12 mb-2">
                            <b>¡Gracias totales!</b>
                          </div>
                        </h4>
            
                      </div>
                    </div>
                    <div class="row text-center">
                      <div class="col-12 mb-2">
                        Revisa tu correo donde encontraras tu recibo de pago y un mensaje especial.
                      </div>
                    </div>
                    <div class="row text-center">
                      <div class="col-12">
                        <a href="../' . $uname . '" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
            }else{
              echo 'Houston tenemos problemas';
            }
          } else {
            echo 'Houston tenemos problemas';
          }
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
          header('Location: ../algosaliomal/');
        }
      }
    } else {
      echo "Error: " . $sqli . "<br>" . $conn->error;
      header('Location: ../algosaliomal/');
    }
  } else if ($status == "3") {
    $uname = test_input($_POST["uname"]);
    $idPay = test_input($_POST["idPay"]);
    $typeB = test_input($_POST["typeB"]);
    $brand = test_input($_POST["brand"]);
    $cardNo = test_input($_POST["cardNo"]);
    $bank = test_input($_POST["bank"]);
    $satusB = test_input($_POST["status"]);
    $date = test_input($_POST["date"]);
    $amount = test_input($_POST["amount"]);
    $amountF = "";
    $amountT = "";
    $questAnswer = test_input($_POST["questAnswer"]);
    $endPeriod = test_input($_POST["period_end_date"]);
    $customerID = test_input($_POST["customerID"]);
    $cardID = test_input($_POST["cardID"]);
    $titleExtra = test_input($_POST["titleExtra"]);
    $emailHost = test_input($_POST["emailHost"]);

    $sqli = "INSERT INTO payments (id_user, id_openpay, type, brand, card_number, bank_name, status, date, amount, amount_fee, amount_tax, description, email_user, note_fan, isPublic_note_fan, id_extra, question_answer, period_end_date, customer_id, card_id)
      VALUES ('$idUser', '$idPay', '$typeB', '$brand', '$cardNo', '$bank', '$satusB', '$date', '$amount', '$amountF', '$amountT', '$description', '$email', '$noteFan', '$isPublic', '$idExtra', '$questAnswer', '$endPeriod', '$customerID', '$cardID')";

    if ($conn->query($sqli) === TRUE) {

      $sql1 = "SELECT email FROM users WHERE email='" . $email . "'";
      $result1 = $conn->query($sql1);

      if ($result1->num_rows > 0) {
        // output data of each row
        if (sendMailGraciasSubs($email, $uname, $confirmationM, $titleExtra)) {
          if(sendMailHostSubs($emailHost, $uname, $titleExtra)){
            echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="container">
                    <div class="row text-center">
                      <h4 class="modal-title w-100" id="exampleModalLongTitle">
                        <div class="col-12 mb-2">
                          <i class="fas fa-user-alt"></i>
                        </div>
                        <div class="col-12 mb-2">
                          <span class="bg-dark text-white p-1 rounded small">' . $uname . '</span>
                        </div>
                        <div class="col-12 mb-2">
                          <b>¡Gracias totales!</b>
                        </div>
                      </h4>
          
                    </div>
                  </div>
                  <div class="row text-center">
                    <div class="col-12 mb-2">
                    Tu suscripción se encuentra en proceso. Entra a tu cuenta donde puedes administrar tu suscripción, asi como tambien encontrar tu primer recibo de pago, en tu correo un mensaje especial ;).
                    </div>
                  </div>
                  <div class="row text-center">
                    <div class="col-12">
                      <a href="../' . $uname . '" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>';
          }else{
            echo 'Houston tenemos problemas';
          }
        } else {
          echo 'Houston tenemos problemas';
        }
      } else {
        $sql2 = "INSERT INTO users (user_name, email, pwd, date, active)
          VALUES ('', '$email', '/%Chivas%%%%%%(93)123%/', '$today', '2')";

        if ($conn->query($sql2) === TRUE) {
          if (sendMailGraciasSubs($email, $uname, $confirmationM, $titleExtra)) {
            if(sendMailHostSubs($emailHost, $uname, $titleExtra)){
              echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="container">
                      <div class="row text-center">
                        <h4 class="modal-title w-100" id="exampleModalLongTitle">
                          <div class="col-12 mb-2">
                            <i class="fas fa-user-alt"></i>
                          </div>
                          <div class="col-12 mb-2">
                            <span class="bg-dark text-white p-1 rounded small">' . $uname . '</span>
                          </div>
                          <div class="col-12 mb-2">
                            <b>¡Gracias totales!</b>
                          </div>
                        </h4>
            
                      </div>
                    </div>
                    <div class="row text-center">
                      <div class="col-12 mb-2">
                      Tu suscripción se encuentra en proceso. Entra a tu cuenta donde puedes administrar tu suscripción, asi como tambien encontrar tu primer recibo de pago, en tu correo un mensaje especial ;).
                      </div>
                    </div>
                    <div class="row text-center">
                      <div class="col-12">
                        <a href="../' . $uname . '" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
            }else{
              echo 'Houston tenemos problemas';
            }
          } else {
            echo 'Houston tenemos problemas';
          }
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
          header('Location: ../algosaliomal/');
        }
      }
    } else {
      echo "Error: " . $sqli . "<br>" . $conn->error;
      header('Location: ../algosaliomal/');
    }
  } else {
    $today = date("Y-m-d H:i:s");
    $desc = clean($description);
    $sqli = "INSERT INTO payments (id_user, description, email_user, date, note_fan, isPublic_note_fan, id_extra)
      VALUES ('$idUser', '" . $desc . "', '$email', '$today', '$noteFan', '$isPublic', '$idExtra')";

    if ($conn->query($sqli) === TRUE) {
      echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center">
          
              <h4 class="modal-title w-100" id="exampleModalLongTitle"><i class="fas fa-sad-tear fa-3x text-danger mb-2"></i><br><b>Algo salio mal</b></h4>
              <p>Tu pago no ha sido procesado correctamente. No se tienen los fondos suficientes o hubo un problema de red.</p>
              
              <a href="../' . $uname . '" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Prueba de nuevo</a>
            
            </div>
          </div>
        </div>
      </div>';
    } else {
      echo "Error: " . $sqli . "<br>" . $conn->error;
      header('Location: ../algosaliomal/');
    }
  }
} else {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function clean($string)
{
  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function sendMailGracias($email, $uname, $message, $total, $qty)
{

  require_once('../admin/mailer/vendor/autoload.php');
  $mail = new PHPMailer(true);
  $iva = $total * 0.16;
  $subTotal = $total - $iva;
  $today = date("Y-m-d H:i:s");

  try {
    require_once('../admin/serversettingsPhpmailer.php');
    $mail->addAddress($email, 'Fan destacado');     // Add a recipient
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Gracias por tu apoyo | Regalameuncafe';
    $mail->Body    = '<html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <meta name="viewport" content="width=device-width, initial-scale=1" /> <title>Regalame un Cafe</title> <style type="text/css"> img {max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; } a {border: 0; outline: none; } a img {border: none; } td, h1, h2, h3  {font-family: Helvetica, Arial, sans-serif; font-weight: 400; } td {font-size: 13px; line-height: 150%; text-align: left; } body {-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 100%; height: 100%; color: #37302d; background: #ffffff; } table {border-collapse: collapse !important; } h1, h2, h3 {padding: 0; margin: 0; color: #444444; font-weight: 400; line-height: 110%; } h1 {font-size: 35px; } h2 {font-size: 30px; } h3 {font-size: 24px; } h4 {font-size: 18px; font-weight: normal; } .important-font {color: #21BEB4; font-weight: bold; } .hide {display: none !important; } .force-full-width {width: 100% !important; } td.desktop-hide {font-size: 0; height: 0; display: none; color: #ffffff; } </style> <style type="text/css" media="screen"> @media screen {@import url(http://fonts.googleapis.com/css?family=Open+Sans:400); td, h1, h2, h3 {font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif !important; } } </style> <style type="text/css" media="only screen and (max-width: 600px)"> @media only screen and (max-width: 600px) {table[class="w320"] {width: 320px !important; } table[class="w300"] {width: 300px !important; } table[class="w290"] {width: 290px !important; } td[class="w320"] {width: 320px !important; } td[class~="mobile-padding"] {padding-left: 14px !important; padding-right: 14px !important; } td[class*="mobile-padding-left"] {padding-left: 14px !important; } td[class*="mobile-padding-right"] {padding-right: 14px !important; } td[class*="mobile-block"] {display: block !important; width: 100% !important; text-align: left !important; padding-left: 0 !important; padding-right: 0 !important; padding-bottom: 15px !important; } td[class*="mobile-no-padding-bottom"] {padding-bottom: 0 !important; } td[class~="mobile-center"] {text-align: center !important; } table[class*="mobile-center-block"] {float: none !important; margin: 0 auto !important; } *[class*="mobile-hide"] {display: none !important; width: 0 !important; height: 0 !important; line-height: 0 !important; font-size: 0 !important; } td[class*="mobile-border"] {border: 0 !important; } td[class*="desktop-hide"] {display: block !important; font-size: 13px !important; height: 61px !important; padding-top: 10px !important; padding-bottom: 10px !important; color: #444444 !important; } } </style> </head> <body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff"> <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%"> <tr> <td align="center" valign="top" bgcolor="#ffffff"  width="100%"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="background:#1f1f1f" width="100%"> <center> <table cellspacing="0" cellpadding="0" width="600" class="w320"> <tr> <td valign="top" class="mobile-block mobile-no-padding-bottom mobile-center" width="270" style="background:#1f1f1f;padding:10px 10px 10px 20px;"> <a href="#" style="text-decoration:none;"> <img src="https://regalameuncafe.com/images/logo_un.svg" width="142" height="30" alt="Regalame un Cafe"/> </a> </td> <td valign="top" class="mobile-block mobile-center" width="270" style="background:#1f1f1f;padding:10px 15px 10px 10px"> </td> </tr> </table> </center> </td> </tr> <tr> <td style="border-bottom:1px solid #e7e7e7;"> <center> <table cellpadding="0" cellspacing="0" width="600" class="w320"> <tr> <td align="left" class="mobile-padding" style="padding:20px"> <br class="mobile-hide" /> <div> <h3>Infinitas Gracias</h3><br> Tu apoyo ahora es una realidad.<br> Aqui un mensaje especial:<br> <p>' . $uname . '<br><i>"' . $message . '"</i></p> <br> </div> <br> <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff"> <tr> <td style="width:100px;background:#D84A38;"> <div> <!--[if mso]> <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38"> <w:anchorlock/> <center> <![endif]--> <a href="https://regalameuncafe.com/' . $uname . '/"style="background-color:#D84A38;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;">Regalar otro Cafe</a> <!--[if mso]> </center> </v:rect> <![endif]--> </div> </td> <td width="281" style="background-color:#ffffff; font-size:0; line-height:0;">&nbsp;</td> </tr> </table> </td> <td class="mobile-hide" style="padding-top:20px;padding-bottom:0; vertical-align:bottom;" valign="bottom"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td align="right" valign="bottom" style="padding-bottom:0; vertical-align:bottom;"> <img  style="vertical-align:bottom;" src="https://regalameuncafe.com/images/love_mail.svg"  width="174" height="294" /> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td valign="top" style="background-color:#f8f8f8;border-bottom:1px solid #e7e7e7;"> <center> <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;"> <tr> <td valign="top" class="mobile-padding" style="padding:20px;"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-right:20px"> <b>Cafe para</b> </td> <td style="padding-right:20px"> <b>Cantidad</b> </td> <td> <b>Monto</b> </td> </tr> <tr> <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; "> ' . $uname . ' </td> <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;"> ' . $qty . ' </td> <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile"> $' . $total . ' </td> </tr> </table> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-top:35px;"> <table cellpadding="0" cellspacing="0" width="100%"> <tr> <td width="350" class="mobile-hide" style="vertical-align:top;"> No se puede comprar la felicidad pero si un buen café :)<br> <p>Equipo RegalameunCafe<br>ayuda@regalameuncafe.com<p> </td> <td style="padding:0px 0 15px 30px;" class="mobile-block"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td>Subtotal:</td> <td><b> $' . $subTotal . '</b></td> </tr> <tr> <td>IVA</td> <td>$' . $iva . '</td> </tr> <tr> <td>Total:</td> <td><b>$' . $total . '</b></td> </tr> <tr> <td>Fecha:</td> <td>' . $today . '</td> </tr> </table> </td> </tr> <tr> <td style="vertical-align:top;" class="desktop-hide"> Thank you for your business. Please contact us with any questions regarding this invoice,<br><br> Awesome Co </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td style="background-color:#1f1f1f;"> <center> <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;color:#ffffff" bgcolor="#1f1f1f" > <tr> <td align="right" valign="middle" class="mobile-padding" style="font-size:12px;padding:20px; background-color:#1f1f1f; color:#ffffff; text-align:left; "> <a style="color:#ffffff;" href="mailto:ayuda@regalameuncafe.com?Subject=Necesito%20ayuda">Soporte</a>&nbsp;&nbsp;|&nbsp;&nbsp; </td> </tr> </table> </center> </td> </tr> </table> </td> </tr> </table> </body> </html>';
    $mail->AltBody = 'Gracias por tu apoyo!';
    $mail->send();
    return true;
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
  }
}

function sendMailGraciasSubs($email, $uname, $message, $plan)
{

  require_once('../admin/mailer/vendor/autoload.php');
  $mail = new PHPMailer(true);
  $today = date("Y-m-d H:i:s");
  
  try {
    require_once('../admin/serversettingsPhpmailer.php');
    $mail->addAddress($email, 'Fan destacado');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Gracias por tu apoyo | Regalameuncafe';
    $mail->Body    = '<html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <meta name="viewport" content="width=device-width, initial-scale=1" /> <title>Regalame un Cafe</title> <style type="text/css"> img {max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; } a {border: 0; outline: none; } a img {border: none; } td, h1, h2, h3 {font-family: Helvetica, Arial, sans-serif; font-weight: 400; } td {font-size: 13px; line-height: 150%; text-align: left; } body {-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100%; height: 100%; color: #37302d; background: #ffffff; } table {border-collapse: collapse !important; } h1, h2, h3 {padding: 0; margin: 0; color: #444444; font-weight: 400; line-height: 110%; } h1 {font-size: 35px; } h2 {font-size: 30px; } h3 {font-size: 24px; } h4 {font-size: 18px; font-weight: normal; } .important-font {color: #21beb4; font-weight: bold; } .hide {display: none !important; } .force-full-width {width: 100% !important; } td.desktop-hide {font-size: 0; height: 0; display: none; color: #ffffff; } </style> <style type="text/css" media="screen"> @media screen {@import url(http://fonts.googleapis.com/css?family=Open+Sans:400); td, h1, h2, h3 {font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif !important; } } </style> <style type="text/css" media="only screen and (max-width: 600px)"> @media only screen and (max-width: 600px) {table[class="w320"] {width: 320px !important; } table[class="w300"] {width: 300px !important; } table[class="w290"] {width: 290px !important; } td[class="w320"] {width: 320px !important; } td[class~="mobile-padding"] {padding-left: 14px !important; padding-right: 14px !important; } td[class*="mobile-padding-left"] {padding-left: 14px !important; } td[class*="mobile-padding-right"] {padding-right: 14px !important; } td[class*="mobile-block"] {display: block !important; width: 100% !important; text-align: left !important; padding-left: 0 !important; padding-right: 0 !important; padding-bottom: 15px !important; } td[class*="mobile-no-padding-bottom"] {padding-bottom: 0 !important; } td[class~="mobile-center"] {text-align: center !important; } table[class*="mobile-center-block"] {float: none !important; margin: 0 auto !important; } *[class*="mobile-hide"] {display: none !important; width: 0 !important; height: 0 !important; line-height: 0 !important; font-size: 0 !important; } td[class*="mobile-border"] {border: 0 !important; } td[class*="desktop-hide"] {display: block !important; font-size: 13px !important; height: 61px !important; padding-top: 10px !important; padding-bottom: 10px !important; color: #444444 !important; } } </style> </head> <body class="body"style="padding: 0; margin: 0; display: block; background: #ffffff; -webkit-text-size-adjust: none; "bgcolor="#ffffff"> <table align="center"cellpadding="0"cellspacing="0"width="100%"height="100%"> <tr> <td align="center" valign="top" bgcolor="#ffffff" width="100%"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="background: #1f1f1f" width="100%"> <center> <table cellspacing="0"cellpadding="0"width="600"class="w320"> <tr> <td valign="top"class="mobile-block mobile-no-padding-bottom mobile-center "width="270"style="background: #1f1f1f; padding: 10px 10px 10px 20px; "> <a href="#" style="text-decoration: none"> <img src="https://regalameuncafe.com/images/logo_un.svg"width="142"height="30"alt="Your Logo"/> </a> </td> <td valign="top"class="mobile-block mobile-center"width="270"style="background: #1f1f1f; padding: 10px 15px 10px 10px; "></td> </tr> </table> </center> </td> </tr> <tr> <td style="border-bottom: 1px solid #e7e7e7"> <center> <table cellpadding="0"cellspacing="0"width="600"class="w320"> <tr> <td align="left"class="mobile-padding"style="padding: 20px"> <br class="mobile-hide" /> <div> <h3>Infinitas Gracias</h3> <br /> Tu apoyo ahora es una realidad.<br /> Aqui un mensaje especial:<br /> <p><i>"'.$message.'"</i></p> <br /> </div> <br /> <table cellspacing="0"cellpadding="0"width="100%"bgcolor="#ffffff"> <tr> <td style="width: 100px; background: #d84a38"> <div> <!--[if mso]> <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38"> <w:anchorlock/> <center> <![endif]--> <a href="https://regalameuncafe.com/' . $uname . '/"style="background-color: #d84a38; color: #ffffff; display: inline-block; font-family: sans-serif; font-size: 13px; font-weight: bold; line-height: 33px; text-align: center; text-decoration: none; width: 150px; -webkit-text-size-adjust: none; ">Regalar un Cafe</a > <!--[if mso]> </center> </v:rect> <![endif]--> </div> </td> <td width="281"style="background-color: #ffffff; font-size: 0; line-height: 0; "> &nbsp; </td> </tr> </table> </td> <td class="mobile-hide"style="padding-top: 20px; padding-bottom: 0; vertical-align: bottom; "valign="bottom"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td align="right"valign="bottom"style="padding-bottom: 0; vertical-align: bottom"> <img style="vertical-align: bottom"src="https://regalameuncafe.com/images/love_mail.svg"width="174"height="294"/> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td valign="top"style="background-color: #f8f8f8; border-bottom: 1px solid #e7e7e7; "> <center> <table border="0"cellpadding="0"cellspacing="0"width="600"class="w320"style="height: 100%"> <tr> <td valign="top"class="mobile-padding"style="padding: 20px"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-right: 20px"> <b>Subscripción</b> </td> <td style="padding-right: 20px"> <b>Fecha de corte</b> </td> <td> <b>Monto</b> </td> </tr> <tr> <td style="padding-top: 5px; padding-right: 20px; border-top: 1px solid #e7e7e7; "> ' . $plan . '</td> <td style="padding-top: 5px; padding-right: 20px; border-top: 1px solid #e7e7e7; "> Pendiente </td> <td style="padding-top: 5px; border-top: 1px solid #e7e7e7; "class="mobile"> $' . $total . '</td> </tr> </table> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-top: 35px"> <table cellpadding="0"cellspacing="0"width="100%"> <tr> <td width="350"class="mobile-hide"style="vertical-align: top"> No se puede comprar la felicidad pero si un buen café :)<br /> <p> Equipo RegalameunCafe<br />ayuda@regalameuncafe.com </p> <p></p> </td> <td style="padding: 0px 0 15px 30px"class="mobile-block"> <table cellspacing="0"cellpadding="0"width="100%"> <tr> <td>Subtotal:</td> <td><b> - </b></td> </tr> <tr> <td>IVA</td> <td>-</td> </tr> <tr> <td>Total:</td> <td><b>$' . $total . '</b></td> </tr> <tr> <td>Fecha:</td> <td>' . $today . '</td> </tr> </table> </td> </tr> <tr> <td style="vertical-align: top"class="desktop-hide"></td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td style="background-color: #1f1f1f"> <center> <table border="0"cellpadding="0"cellspacing="0"width="600"class="w320"style="height: 100%; color: #ffffff"bgcolor="#1f1f1f"> <tr> <td align="right"valign="middle"class="mobile-padding"style="font-size: 12px; padding: 20px; background-color: #1f1f1f; color: #ffffff; text-align: left; "> <a style="color: #ffffff"href="mailto:ayuda@regalameuncafe.com?Subject=Necesito%20ayuda">Soporte</a >&nbsp;&nbsp;|&nbsp;&nbsp; </td> </tr> </table> </center> </td> </tr> </table> </td> </tr> </table> </body> </html>';
    $mail->AltBody = 'Gracias por tu apoyo!';
    $mail->send();
    return true;
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
  }
}

function sendMailHostCoffee($email, $uname)
{

  require_once('../admin/mailer/vendor/autoload.php');
  $mail = new PHPMailer(true);
  $iva = $total * 0.16;
  $subTotal = $total - $iva;
  $today = date("Y-m-d H:i:s");

  try {
    require_once('../admin/serversettingsPhpmailer.php');
    $mail->addAddress($email, $uname);     // Add a recipient
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Nuevo café | Regalameuncafe';
    $mail->Body    = '<html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <meta name="viewport" content="width=device-width, initial-scale=1" /> <title>Regalame un Cafe</title> <style type="text/css"> img {max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; } a {border: 0; outline: none; } a img {border: none; } td, h1, h2, h3 {font-family: Helvetica, Arial, sans-serif; font-weight: 400; } td {font-size: 13px; line-height: 150%; text-align: left; } body {-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100%; height: 100%; color: #37302d; background: #ffffff; } table {border-collapse: collapse !important; } h1, h2, h3 {padding: 0; margin: 0; color: #444444; font-weight: 400; line-height: 110%; } h1 {font-size: 35px; } h2 {font-size: 30px; } h3 {font-size: 24px; } h4 {font-size: 18px; font-weight: normal; } .important-font {color: #21beb4; font-weight: bold; } .hide {display: none !important; } .force-full-width {width: 100% !important; } td.desktop-hide {font-size: 0; height: 0; display: none; color: #ffffff; } </style> <style type="text/css" media="screen"> @media screen {@import url(http://fonts.googleapis.com/css?family=Open+Sans:400); td, h1, h2, h3 {font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif !important; } } </style> <style type="text/css" media="only screen and (max-width: 600px)"> @media only screen and (max-width: 600px) {table[class="w320"] {width: 320px !important; } table[class="w300"] {width: 300px !important; } table[class="w290"] {width: 290px !important; } td[class="w320"] {width: 320px !important; } td[class~="mobile-padding"] {padding-left: 14px !important; padding-right: 14px !important; } td[class*="mobile-padding-left"] {padding-left: 14px !important; } td[class*="mobile-padding-right"] {padding-right: 14px !important; } td[class*="mobile-block"] {display: block !important; width: 100% !important; text-align: left !important; padding-left: 0 !important; padding-right: 0 !important; padding-bottom: 15px !important; } td[class*="mobile-no-padding-bottom"] {padding-bottom: 0 !important; } td[class~="mobile-center"] {text-align: center !important; } table[class*="mobile-center-block"] {float: none !important; margin: 0 auto !important; } *[class*="mobile-hide"] {display: none !important; width: 0 !important; height: 0 !important; line-height: 0 !important; font-size: 0 !important; } td[class*="mobile-border"] {border: 0 !important; } td[class*="desktop-hide"] {display: block !important; font-size: 13px !important; height: 61px !important; padding-top: 10px !important; padding-bottom: 10px !important; color: #444444 !important; } } </style> </head> <body class="body"style="padding: 0; margin: 0; display: block; background: #ffffff; -webkit-text-size-adjust: none; "bgcolor="#ffffff"> <table align="center"cellpadding="0"cellspacing="0"width="100%"height="100%"> <tr> <td align="center" valign="top" bgcolor="#ffffff" width="100%"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="background: #1f1f1f" width="100%"> <center> <table cellspacing="0"cellpadding="0"width="600"class="w320"> <tr> <td valign="top"class="mobile-block mobile-no-padding-bottom mobile-center "width="270"style="background: #1f1f1f; padding: 10px 10px 10px 20px; "> <a href="#" style="text-decoration: none"> <img src="https://regalameuncafe.com/images/logo_un.svg"width="142"height="30"alt="Your Logo"/> </a> </td> <td valign="top"class="mobile-block mobile-center"width="270"style="background: #1f1f1f; padding: 10px 15px 10px 10px; "></td> </tr> </table> </center> </td> </tr> <tr> <td style="border-bottom: 1px solid #e7e7e7"> <center> <table cellpadding="0"cellspacing="0"width="600"class="w320"> <tr> <td align="left"class="mobile-padding"style="padding: 20px"> <br class="mobile-hide" /> <div> <h3>Te han regalado un cafe</h3> <br /> Entra a tu cuenta para revisar.<br /> Muy pronto te estaremos transfiriendo tu dinero.<br /> <br /> </div> <br /> <table cellspacing="0"cellpadding="0"width="100%"bgcolor="#ffffff"> <tr> <td style="width: 100px; background: #d84a38"> <div> <!--[if mso]> <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38"> <w:anchorlock/> <center> <![endif]--> <a href="https://regalameuncafe.com/"style="background-color: #d84a38; color: #ffffff; display: inline-block; font-family: sans-serif; font-size: 13px; font-weight: bold; line-height: 33px; text-align: center; text-decoration: none; width: 150px; -webkit-text-size-adjust: none; ">Entrar a mi cuenta</a > <!--[if mso]> </center> </v:rect> <![endif]--> </div> </td> <td width="281"style="background-color: #ffffff; font-size: 0; line-height: 0; "> &nbsp; </td> </tr> </table> </td> <td class="mobile-hide"style="padding-top: 20px; padding-bottom: 0; vertical-align: bottom; "valign="bottom"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td align="right"valign="bottom"style="padding-bottom: 0; vertical-align: bottom"> <img style="vertical-align: bottom"src="https://regalameuncafe.com/images/love_mail.svg"width="174"height="294"/> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td valign="top"style="background-color: #f8f8f8; border-bottom: 1px solid #e7e7e7; "> <center> <table border="0"cellpadding="0"cellspacing="0"width="600"class="w320"style="height: 100%"> <tr> <td valign="top"class="mobile-padding"style="padding: 20px"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-right: 20px"></td> <td style="padding-right: 20px"></td> <td></td> </tr> <tr> <td style="padding-top: 5px; padding-right: 20px; border-top: 1px solid #e7e7e7; "></td> <td style="padding-top: 5px; padding-right: 20px; border-top: 1px solid #e7e7e7; "></td> <td style="padding-top: 5px; border-top: 1px solid #e7e7e7; "class="mobile"></td> </tr> </table> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-top: 35px"> <table cellpadding="0"cellspacing="0"width="100%"> <tr> <td width="350"class="mobile-hide"style="vertical-align: top"> No se puede comprar la felicidad pero si un buen café :)<br /> <p> Equipo RegalameunCafe<br />ayuda@regalameuncafe.com </p> <p></p> </td> <td style="padding: 0px 0 15px 30px"class="mobile-block"> <table cellspacing="0"cellpadding="0"width="100%"> <tr> <td></td> <td></td> </tr> <tr> <td></td> <td></td> </tr> <tr> <td></td> <td></td> </tr> <tr> <td></td> <td></td> </tr> </table> </td> </tr> <tr> <td style="vertical-align: top"class="desktop-hide"> Thank you for your business. Please contact us with any questions regarding this invoice,<br /><br /> Awesome Co </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td style="background-color: #1f1f1f"> <center> <table border="0"cellpadding="0"cellspacing="0"width="600"class="w320"style="height: 100%; color: #ffffff"bgcolor="#1f1f1f"> <tr> <td align="right"valign="middle"class="mobile-padding"style="font-size: 12px; padding: 20px; background-color: #1f1f1f; color: #ffffff; text-align: left; "> <a style="color: #ffffff"href="mailto:ayuda@regalameuncafe.com?Subject=Necesito%20ayuda">Soporte</a >&nbsp;&nbsp;|&nbsp;&nbsp; </td> </tr> </table> </center> </td> </tr> </table> </td> </tr> </table> </body> </html>';
    $mail->AltBody = 'Gracias por tu apoyo!';
    $mail->send();
    return true;
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
  }
}

function sendMailHostSubs($email, $uname, $title)
{

  require_once('../admin/mailer/vendor/autoload.php');
  $mail = new PHPMailer(true);
  $iva = $total * 0.16;
  $subTotal = $total - $iva;
  $today = date("Y-m-d H:i:s");

  try {
    require_once('../admin/serversettingsPhpmailer.php');
    $mail->addAddress($email, $uname);     // Add a recipient
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Nueva suscripción | Regalameuncafe';
    $mail->Body    = '<html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <meta name="viewport" content="width=device-width, initial-scale=1" /> <title>Regalame un Cafe</title> <style type="text/css"> img {max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; } a {border: 0; outline: none; } a img {border: none; } td, h1, h2, h3 {font-family: Helvetica, Arial, sans-serif; font-weight: 400; } td {font-size: 13px; line-height: 150%; text-align: left; } body {-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100%; height: 100%; color: #37302d; background: #ffffff; } table {border-collapse: collapse !important; } h1, h2, h3 {padding: 0; margin: 0; color: #444444; font-weight: 400; line-height: 110%; } h1 {font-size: 35px; } h2 {font-size: 30px; } h3 {font-size: 24px; } h4 {font-size: 18px; font-weight: normal; } .important-font {color: #21beb4; font-weight: bold; } .hide {display: none !important; } .force-full-width {width: 100% !important; } td.desktop-hide {font-size: 0; height: 0; display: none; color: #ffffff; } </style> <style type="text/css" media="screen"> @media screen {@import url(http://fonts.googleapis.com/css?family=Open+Sans:400); td, h1, h2, h3 {font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif !important; } } </style> <style type="text/css" media="only screen and (max-width: 600px)"> @media only screen and (max-width: 600px) {table[class="w320"] {width: 320px !important; } table[class="w300"] {width: 300px !important; } table[class="w290"] {width: 290px !important; } td[class="w320"] {width: 320px !important; } td[class~="mobile-padding"] {padding-left: 14px !important; padding-right: 14px !important; } td[class*="mobile-padding-left"] {padding-left: 14px !important; } td[class*="mobile-padding-right"] {padding-right: 14px !important; } td[class*="mobile-block"] {display: block !important; width: 100% !important; text-align: left !important; padding-left: 0 !important; padding-right: 0 !important; padding-bottom: 15px !important; } td[class*="mobile-no-padding-bottom"] {padding-bottom: 0 !important; } td[class~="mobile-center"] {text-align: center !important; } table[class*="mobile-center-block"] {float: none !important; margin: 0 auto !important; } *[class*="mobile-hide"] {display: none !important; width: 0 !important; height: 0 !important; line-height: 0 !important; font-size: 0 !important; } td[class*="mobile-border"] {border: 0 !important; } td[class*="desktop-hide"] {display: block !important; font-size: 13px !important; height: 61px !important; padding-top: 10px !important; padding-bottom: 10px !important; color: #444444 !important; } } </style> </head> <body class="body"style="padding: 0; margin: 0; display: block; background: #ffffff; -webkit-text-size-adjust: none; "bgcolor="#ffffff"> <table align="center"cellpadding="0"cellspacing="0"width="100%"height="100%"> <tr> <td align="center" valign="top" bgcolor="#ffffff" width="100%"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="background: #1f1f1f" width="100%"> <center> <table cellspacing="0"cellpadding="0"width="600"class="w320"> <tr> <td valign="top"class="mobile-block mobile-no-padding-bottom mobile-center "width="270"style="background: #1f1f1f; padding: 10px 10px 10px 20px; "> <a href="#" style="text-decoration: none"> <img src="https://regalameuncafe.com/images/logo_un.svg"width="142"height="30"alt="Your Logo"/> </a> </td> <td valign="top"class="mobile-block mobile-center"width="270"style="background: #1f1f1f; padding: 10px 15px 10px 10px; "></td> </tr> </table> </center> </td> </tr> <tr> <td style="border-bottom: 1px solid #e7e7e7"> <center> <table cellpadding="0"cellspacing="0"width="600"class="w320"> <tr> <td align="left"class="mobile-padding"style="padding: 20px"> <br class="mobile-hide" /> <div> <h3>Se han suscrito a: <b>'.$title.'</b></h3> <br /> Entra a tu cuenta para revisar y aceptarla.<br /> Tan pronto aceptes y valides la suscripción, tan pronto estaremos transfiriendo mes con mes tu dinero.<br /> <br /> </div> <br /> <table cellspacing="0"cellpadding="0"width="100%"bgcolor="#ffffff"> <tr> <td style="width: 100px; background: #d84a38"> <div> <!--[if mso]> <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38"> <w:anchorlock/> <center> <![endif]--> <a href="https://regalameuncafe.com/"style="background-color: #d84a38; color: #ffffff; display: inline-block; font-family: sans-serif; font-size: 13px; font-weight: bold; line-height: 33px; text-align: center; text-decoration: none; width: 150px; -webkit-text-size-adjust: none; ">Entrar a mi cuenta</a > <!--[if mso]> </center> </v:rect> <![endif]--> </div> </td> <td width="281"style="background-color: #ffffff; font-size: 0; line-height: 0; "> &nbsp; </td> </tr> </table> </td> <td class="mobile-hide"style="padding-top: 20px; padding-bottom: 0; vertical-align: bottom; "valign="bottom"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td align="right"valign="bottom"style="padding-bottom: 0; vertical-align: bottom"> <img style="vertical-align: bottom"src="https://regalameuncafe.com/images/love_mail.svg"width="174"height="294"/> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td valign="top"style="background-color: #f8f8f8; border-bottom: 1px solid #e7e7e7; "> <center> <table border="0"cellpadding="0"cellspacing="0"width="600"class="w320"style="height: 100%"> <tr> <td valign="top"class="mobile-padding"style="padding: 20px"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-right: 20px"></td> <td style="padding-right: 20px"></td> <td></td> </tr> <tr> <td style="padding-top: 5px; padding-right: 20px; border-top: 1px solid #e7e7e7; "></td> <td style="padding-top: 5px; padding-right: 20px; border-top: 1px solid #e7e7e7; "></td> <td style="padding-top: 5px; border-top: 1px solid #e7e7e7; "class="mobile"></td> </tr> </table> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-top: 35px"> <table cellpadding="0"cellspacing="0"width="100%"> <tr> <td width="350"class="mobile-hide"style="vertical-align: top"> No se puede comprar la felicidad pero si un buen café :)<br /> <p> Equipo RegalameunCafe<br />ayuda@regalameuncafe.com </p> <p></p> </td> <td style="padding: 0px 0 15px 30px"class="mobile-block"> <table cellspacing="0"cellpadding="0"width="100%"> <tr> <td></td> <td></td> </tr> <tr> <td></td> <td></td> </tr> <tr> <td></td> <td></td> </tr> <tr> <td></td> <td></td> </tr> </table> </td> </tr> <tr> <td style="vertical-align: top"class="desktop-hide"> Thank you for your business. Please contact us with any questions regarding this invoice,<br /><br /> Awesome Co </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td style="background-color: #1f1f1f"> <center> <table border="0"cellpadding="0"cellspacing="0"width="600"class="w320"style="height: 100%; color: #ffffff"bgcolor="#1f1f1f"> <tr> <td align="right"valign="middle"class="mobile-padding"style="font-size: 12px; padding: 20px; background-color: #1f1f1f; color: #ffffff; text-align: left; "> <a style="color: #ffffff"href="mailto:ayuda@regalameuncafe.com?Subject=Necesito%20ayuda">Soporte</a >&nbsp;&nbsp;|&nbsp;&nbsp; </td> </tr> </table> </center> </td> </tr> </table> </td> </tr> </table> </body> </html>';
    $mail->AltBody = 'Gracias por tu apoyo!';
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