<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);

try{
$mail->isSMTP();
$mail->Host= 'smtp.gmail.com;';
$mail->SMTPAuth   = true;
$mail->Username   = 'saiscommercial@gmail.com';
$mail->Password   = 'Saiscommercial@955';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;
$mail->setFrom('saiscommercial@gmail.com', 'matic');
$mail->addAddress($_SESSION['mail']);
$ran_num= random_int(100000, 999999);
$_SESSION['otp']=$ran_num;
$mail->Subject = 'otp for matic';
$mail->Body =$ran_num ;
$mail->send();
   echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>


