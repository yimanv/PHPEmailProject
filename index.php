<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>

<form action="function.php" method="post">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"> <br>
 <input type="submit" value="Submit">

</form>
<!-- Username is case sensitive -->
<form action="forgetpassword.php" method="post">
  Username: <input type="text" name="username"><br>
 <input type="submit" value="Submit" name="submit">

</form>



<form action="sendmail.php" method="post" id="message">
Name: <input type="text" name="name"><br>
 Email: <input type="email" name="email"><br>
 <input type="submit" value="Submit" name="submit">

</form>

<textarea name="feedback" form="message">Enter text here...</textarea>

<?php
session_start();

if(isset($_SESSION['message']))
{
echo $_SESSION["message"]; 
unset($_SESSION['message']);

}

?>

</body>
</html>