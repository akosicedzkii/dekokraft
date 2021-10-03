<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // or 587
$mail->IsHTML(true);
$mail->Username = "mailerunioil@gmail.com";
$mail->Password = "p@ssw0rd123";
$mail->SetFrom("mailerunioil@gmail.com","Mailer");
$mail->Subject = $_POST["subject"];
$body = "<html>\n"; 
$body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n"; 
$body .= $_POST["body"]; 
$body .= "</body>\n"; 
$body .= "</html>\n"; 
if($_POST["attachment"] != "")
{
	$mail->AddAttachment("attachment/".$_POST["attachment"]);
}
$mail->Body = $body;
$mail->AddAddress($_POST["to"]);
 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message sent";
 }