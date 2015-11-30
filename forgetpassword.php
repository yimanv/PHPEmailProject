<?php
require 'PHPMailer-master/PHPMailerAutoload.php';
  session_start();
$usersname=$_POST['username'];
$servername = "localhost";
$username = "root";
$password = "";
$success=0;
try {
    $conn = new PDO("mysql:host=$servername;dbname=project", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

$sql = "SELECT * FROM logindata WHERE username ='".$usersname."'";


    foreach ($conn->query($sql) as $row) {


if($row['Username']==$usersname)
{
$success=1;
$mail = new PHPMailer;
 
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'youremailaddress@.com';                   // SMTP username
$mail->Password = 'yourpassword';               // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
$mail->setFrom('youremailadress@.com','Your Name');     //Set who the message is to be sent from
$mail->addAddress($row['Email'], '');
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(false);                                  // Set email format to HTML
 
$mail->Subject = 'Password Recovery';
$mail->Body    ="Your password is".$row['Password'];
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
echo 'password recovery email sent';
}
else 
{    header('Location:index.php');
}

   
    }

if($success==0)
{

$_SESSION["message"] = "Username Invalid";
header('Location:index.php');
}



?>