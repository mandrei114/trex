<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$firstname = mysql_real_escape_string($_POST['firstname']);
    $lastname = mysql_real_escape_string($_POST['lastname']);
	$email = mysql_real_escape_string($_POST['email']);
	$upass = md5(mysql_real_escape_string($_POST['pass']));
	
	$firstname = trim($firstname);
    $lastname = trim($lastname);
	$email = trim($email);
	$upass = trim($upass);
	
	// email exist or not
	$query = "SELECT email FROM user WHERE email='$email'";
	$result = mysql_query($query);
	
	$count = mysql_num_rows($result); // if email not found then register
	
	if($count == 0){
		
		if(mysql_query("INSERT INTO user(email,password, first_name, last_name) VALUES('$email','$upass','$firstname','$lastname')"))
		{
			?>
			<script>alert('successfully registered ');</script>
			<?php
			header('Location: index.php');
		}
		else
		{
			?>
			<script>alert('error while registering you...');</script>
			<?php
		}		
	}
	else{
			?>
			<script>alert('Sorry Email ID already taken ...');</script>
			<?php
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coding Cage - Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="firstname" placeholder="Nume" required /></td>
</tr>
<tr>
<td><input type="text" name="lastname" placeholder="Prenume" required /></td>
</tr>
<tr>
<td><input type="email" name="email" placeholder="E-mail" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Parola" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Inregistrare</button></td>
</tr>
<tr>
<td><a href="index.php">Autentificare</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>