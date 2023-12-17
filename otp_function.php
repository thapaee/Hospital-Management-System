<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/vendor/autoload.php';

function send_otp($email,$otp){

// Load Composer's autoloader

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 0;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "project.iwp2020@gmail.com";
$mail->Password   = "IWP20202020";
$mail->isHTML(true);
$mail->AddAddress($email);
$mail->SetFrom("project.iwp2020@gmail.com", "ABC registration");
$mail->Subject = "OTP verification";
$content = "<b>Welcome to the ABC family<br>Your otp for verification is: ".$otp."</b>";
$mail->MsgHTML($content); 
$mail->Send(); 
}

?>