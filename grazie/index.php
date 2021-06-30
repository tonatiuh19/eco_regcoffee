<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">
<link href="../css/fontawesome/css/all.css" rel="stylesheet">
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//session_start(); https://regalameuncafe.com/grazie/?order=93
require_once('../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
if(!isset($_GET['order']) || $_GET['order']=='') {
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.location.href='../';
		</SCRIPT>");    
}else{
	$today = date("Y-m-d H:i:s");
	$sql = "SELECT a.id_payments, a.id_user, a.id_extra, a.email_user, a.id_paypal, a.amount, a.description, b.user_name, c.confirmation,  
	(
	   CASE WHEN EXISTS(SELECT NULL FROM users WHERE a.email_user=users.email)
		  THEN a.email_user 
		  ELSE 0
	   END 
	  )AS userToPay
	FROM payments as a
	INNER JOIN users as b on a.id_user=b.id_user
	INNER JOIN extras as c on c.id_extra=a.id_extra
	WHERE a.id_payments=".$_GET['order']."";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$whatIWant = substr($row["description"], strpos($row["description"], "|") + 1);
			if($row["userToPay"] == '0'){
				$sql2 = "INSERT INTO users (user_name, email, pwd, date, active)
				VALUES ('', '".$row["email_user"]."', '/%Chivas%%%%%%(93)123%/', '$today', '2')";
	  
				if ($conn->query($sql2) === TRUE) {
					if (sendMailGracias($row["email_user"], $row["user_name"], $row["confirmation"], $row["amount"], $whatIWant)) {
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
									<span class="bg-dark text-white p-1 rounded small">' . $row["user_name"] . '</span>
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
								<a href="../' . $row["user_name"] . '" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
							</div>
							</div>
						</div>
						</div>
					</div>
					</div>';
					} else {
					echo 'Houston tenemos problemas';
					}
				} else {
					echo "Error: " . $sql2 . "<br>" . $conn->error;
				}
			}else{
				if (sendMailGracias($row["email_user"], $row["user_name"], $row["confirmation"], $row["amount"], $whatIWant)) {
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
										<span class="bg-dark text-white p-1 rounded small">' . $row["user_name"] . '</span>
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
									<a href="../' . $row["user_name"] . '" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
									</div>
								</div>
								</div>
							</div>
							</div>
						</div>';
				} else {
					echo 'Houston tenemos problemas';
				}
			}
		}
	} else {
		echo "0 results";
	}
}


function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
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
    $mail->setLanguage('es', '../admin/mailer/vendor/phpmailer/phpmailer/language');
    $mail->addAddress($email, 'Fan destacado');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Gracias por tu apoyo | Regalameuncafe';
    $mail->Body    = '<html> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <meta name="viewport" content="width=device-width, initial-scale=1" /> <title>Regalame un Cafe</title> <style type="text/css"> img {max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; } a {border: 0; outline: none; } a img {border: none; } td, h1, h2, h3  {font-family: Helvetica, Arial, sans-serif; font-weight: 400; } td {font-size: 13px; line-height: 150%; text-align: left; } body {-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 100%; height: 100%; color: #37302d; background: #ffffff; } table {border-collapse: collapse !important; } h1, h2, h3 {padding: 0; margin: 0; color: #444444; font-weight: 400; line-height: 110%; } h1 {font-size: 35px; } h2 {font-size: 30px; } h3 {font-size: 24px; } h4 {font-size: 18px; font-weight: normal; } .important-font {color: #21BEB4; font-weight: bold; } .hide {display: none !important; } .force-full-width {width: 100% !important; } td.desktop-hide {font-size: 0; height: 0; display: none; color: #ffffff; } </style> <style type="text/css" media="screen"> @media screen {@import url(http://fonts.googleapis.com/css?family=Open+Sans:400); td, h1, h2, h3 {font-family: "Open Sans", "Helvetica Neue", Arial, sans-serif !important; } } </style> <style type="text/css" media="only screen and (max-width: 600px)"> @media only screen and (max-width: 600px) {table[class="w320"] {width: 320px !important; } table[class="w300"] {width: 300px !important; } table[class="w290"] {width: 290px !important; } td[class="w320"] {width: 320px !important; } td[class~="mobile-padding"] {padding-left: 14px !important; padding-right: 14px !important; } td[class*="mobile-padding-left"] {padding-left: 14px !important; } td[class*="mobile-padding-right"] {padding-right: 14px !important; } td[class*="mobile-block"] {display: block !important; width: 100% !important; text-align: left !important; padding-left: 0 !important; padding-right: 0 !important; padding-bottom: 15px !important; } td[class*="mobile-no-padding-bottom"] {padding-bottom: 0 !important; } td[class~="mobile-center"] {text-align: center !important; } table[class*="mobile-center-block"] {float: none !important; margin: 0 auto !important; } *[class*="mobile-hide"] {display: none !important; width: 0 !important; height: 0 !important; line-height: 0 !important; font-size: 0 !important; } td[class*="mobile-border"] {border: 0 !important; } td[class*="desktop-hide"] {display: block !important; font-size: 13px !important; height: 61px !important; padding-top: 10px !important; padding-bottom: 10px !important; color: #444444 !important; } } </style> </head> <body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff"> <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%"> <tr> <td align="center" valign="top" bgcolor="#ffffff"  width="100%"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="background:#1f1f1f" width="100%"> <center> <table cellspacing="0" cellpadding="0" width="600" class="w320"> <tr> <td valign="top" class="mobile-block mobile-no-padding-bottom mobile-center" width="270" style="background:#1f1f1f;padding:10px 10px 10px 20px;"> <a href="#" style="text-decoration:none;"> <img src="https://regalameuncafe.com/images/logo_un.png" width="142" height="30" alt="Regalame un Cafe"/> </a> </td> <td valign="top" class="mobile-block mobile-center" width="270" style="background:#1f1f1f;padding:10px 15px 10px 10px"> </td> </tr> </table> </center> </td> </tr> <tr> <td style="border-bottom:1px solid #e7e7e7;"> <center> <table cellpadding="0" cellspacing="0" width="600" class="w320"> <tr> <td align="left" class="mobile-padding" style="padding:20px"> <br class="mobile-hide" /> <div> <h3>Infinitas Gracias</h3><br> Tu apoyo ahora es una realidad.<br> Aqui un mensaje especial:<br> <p>' . $uname . '<br><i>"' . $message . '"</i></p> <br> </div> <br> <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff"> <tr> <td style="width:100px;background:#D84A38;"> <div> <!--[if mso]> <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38"> <w:anchorlock/> <center> <![endif]--> <a href="https://regalameuncafe.com/' . $uname . '/"style="background-color:#D84A38;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;">Regalar otro Cafe</a> <!--[if mso]> </center> </v:rect> <![endif]--> </div> </td> <td width="281" style="background-color:#ffffff; font-size:0; line-height:0;">&nbsp;</td> </tr> </table> </td> <td class="mobile-hide" style="padding-top:20px;padding-bottom:0; vertical-align:bottom;" valign="bottom"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td align="right" valign="bottom" style="padding-bottom:0; vertical-align:bottom;"> <img  style="vertical-align:bottom;" src="https://regalameuncafe.com/images/love_mail.png"  width="174" height="294" /> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td valign="top" style="background-color:#f8f8f8;border-bottom:1px solid #e7e7e7;"> <center> <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;"> <tr> <td valign="top" class="mobile-padding" style="padding:20px;"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-right:20px"> <b>Cafe para</b> </td> <td style="padding-right:20px"> <b>Cantidad</b> </td> <td> <b>Monto</b> </td> </tr> <tr> <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; "> ' . $uname . ' </td> <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;"> ' . $qty . ' </td> <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile"> $' . $total . ' </td> </tr> </table> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td style="padding-top:35px;"> <table cellpadding="0" cellspacing="0" width="100%"> <tr> <td width="350" class="mobile-hide" style="vertical-align:top;"> No se puede comprar la felicidad pero si un buen café :)<br> <p>Equipo RegalameunCafe<br>ayuda@regalameuncafe.com<p> </td> <td style="padding:0px 0 15px 30px;" class="mobile-block"> <table cellspacing="0" cellpadding="0" width="100%"> <tr> <td></td> <td></td> </tr> <tr> <td></td> <td></td> </tr> <tr> <td>Paypal total:</td> <td><b>$' . $total . '</b></td> </tr> <tr> <td>Fecha:</td> <td>' . $today . '</td> </tr> </table> </td> </tr> <tr> <td style="vertical-align:top;" class="desktop-hide"> Thank you for your business. Please contact us with any questions regarding this invoice,<br><br> Awesome Co </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </center> </td> </tr> <tr> <td style="background-color:#1f1f1f;"> <center> <table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;color:#ffffff" bgcolor="#1f1f1f" > <tr> <td align="right" valign="middle" class="mobile-padding" style="font-size:12px;padding:20px; background-color:#1f1f1f; color:#ffffff; text-align:left; "> <a style="color:#ffffff;" href="mailto:ayuda@regalameuncafe.com?Subject=Necesito%20ayuda">Soporte</a>&nbsp;&nbsp;|&nbsp;&nbsp; </td> </tr> </table> </center> </td> </tr> </table> </td> </tr> </table> </body> </html>';
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