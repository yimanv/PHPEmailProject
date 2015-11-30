<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>

<?php

session_start();
if(!isset($_SESSION['username']))
{
  
    header('Location:index.php');
}


echo "Welcome: " . $_SESSION["username"] . ".<br>";
date_default_timezone_set('America/Toronto');
echo "Current date : ";
echo date("l F d, Y");

?>

Change Password:
<form action="login.php" method="post">
Old password: <input type="password" name="password"><br>
New Password: <input type="password" name="password2"> <br>
Retype Password: <input type="password" name="password3"> <br>
 <input type="submit" value="submit" name="submit">

</form>

<?php
function display()
{
  $_SESSION["password"]=$_POST['password2']; 
$passwords=$_POST['password2'];

$servername = "localhost";
$username = "root";
$password = "";
$success=0;
try {
    $conn = new PDO("mysql:host=$servername;dbname=project", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


$sql = "UPDATE logindata SET Password='".$passwords."' WHERE username ='".$_SESSION["username"]."'";

$conn->query($sql);
echo "password changed";
}
if(isset($_POST['submit']))
{
if ($_POST['password']==$_SESSION["password"])
{
  
if($_POST['password2'] == $_POST['password3'])
{
   display();
}

else {

echo "Passwords don't match";
}
}
else{

echo "Passwords don't match";
}


}


?>

</body>
</html>