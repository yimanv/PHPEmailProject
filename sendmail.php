<?php
require 'PHPMailer-master/PHPMailerAutoload.php';

session_start();
$message=$_POST['feedback'];
$email=$_POST['email']; 
$name=$_POST['name'];
$mail = new PHPMailer;
 
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'youremailaddress@.com';                   // SMTP username
$mail->Password = 'yourpassword';               // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
$mail->setFrom('Youremailaddress@.com', 'Your name');     //Set who the message is to be sent from
$mail->addAddress('youremailaddress@.com', 'Your name');
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(false);                                  // Set email format to HTML
 
$mail->Subject = 'Feedback';
$mail->Body    ="Sent From ".$email." by ".$name." : ".$message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
 
if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
 
$_SESSION["message"] = "Message has been sent";
header('Location:index.php');
echo 'Message has been sent';
?>