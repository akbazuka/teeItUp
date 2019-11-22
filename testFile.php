<?php

require_once 'phpmailer/class.phpmailer.php';
include 'phpmailer/class.smtp.php';

//PHP Mailer; send confirmation email to use when booking is made
//$body = file_get_contents('phpmailer/TeeItUpMail.php');

$body1 = '<h1>Hello</h1>';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.office365.com';
$mail->Port = 587;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username   = 'team@kedlena.com';    
$mail->Password   = 'Pandino0!';    
$mail->setFrom('team@kedlena.com', 'Tee It Up! Team');
$mail->CharSet = 'UTF-8';
$mail->isHTML(true);

//$mail->addAddress($email);
$mail->addAddress('akedlaya@my.hpu.edu');

$mail->Subject = 'Tee It Up- Booking Confirmation';
$mail->msgHTML($body1);
$mail->send();
//        
//    if (!$mail->send()) {
//        echo '<h1 style="font-weight: bold; color: black;>Message was not sent.</h1>';
//        echo '<h1 style="font-weight: bold; color: black;">Mailer error: ' . $mail->ErrorInfo.'</h1>';
//    } else {
//        echo 'Message has been sent.';
//    }
?>