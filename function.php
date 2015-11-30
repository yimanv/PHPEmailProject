<?php
  session_start();
$usersname=$_POST['username'];
$passwords=$_POST['password'];

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

if($row['Password']==$passwords)
{
$success=1;
$_SESSION["username"] = $row['Username'];
$_SESSION["email"] = $row['Email'] ;
$_SESSION["password"] = $row['Password'] ;
    header('Location:login.php');
}
else 
{    header('Location:index.php');
}

   
    }

if($success==0)
{
header('Location:index.php');
}



?>