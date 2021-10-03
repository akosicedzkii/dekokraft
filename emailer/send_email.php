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
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->Username = "senderrednes123@gmail.com";
$mail->Password = "Cedzkii123!";
$mail->SetFrom("senderrednes123@gmail.com",$_POST["emailer_name"]);
$mail->Subject = $_POST["subject"];
//$body = "<html>"; 
////$body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">"; 
$body = urldecode($_POST["body"]); 

//$body .= "</body>"; 
//$body .= "</html>"; 
if($_POST["attachment"] != "")
{
    if($_POST["others"] !="")
    {
        $mail->AddAttachment($_POST["attachment"]);
    }  
    else
    {
        $mail->AddAttachment("attachment/".$_POST["attachment"]);
    }
}
$mail->Body = $body;
$mail->IsHTML(true);
$mail->CharSet = "text/html; charset=UTF-8;";
$mail->ClearCustomHeaders();
$mail->AddAddress($_POST["to"]);
 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message sent";
    
        if($_POST["attachment"] != "")
        {
            if($_POST["others"] =="")
            
            {
                unlink("attachment/".$_POST["attachment"]);
            }
        }
    
 }