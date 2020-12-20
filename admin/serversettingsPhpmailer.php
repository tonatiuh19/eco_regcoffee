<?php
//Server settings
$mail->SMTPDebug = 2;                                       // Enable verbose debug output
// $mail->isSMTP();                                            // Set mailer to use SMTP
$mail->Host       = 'mail.regalameuncafe.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'ayuda@regalameuncafe.com';                     // SMTP username
$mail->Password   = 'Mailer123';                               // SMTP password
$mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
$mail->Port       = 469;                                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//Recipients
$mail->setFrom('ayuda@regalameuncafe.com', 'Regalame un Cafe | Asistente');
$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('ayuda@regalameuncafe.com', 'Regalame un Cafe | Asistente');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

?>