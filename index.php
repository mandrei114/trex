<?php
session_start();
include_once 'dbconnect.php';
include_once 'helper.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['btn-login']))
{
    debug_to_console("am intrat in if");
	$email = mysql_real_escape_string($_POST['email']);
	$upass = mysql_real_escape_string($_POST['pass']);
	
	$email = trim($email);
	$upass = trim($upass);
	
	$res=mysql_query("SELECT id_user, email, password FROM user WHERE email='$email'");
	$row=mysql_fetch_array($res);
	
	$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
	
	if($count == 1 && $row['password']==md5($upass))
	{
		$_SESSION['user'] = $row['id_user'];
		header("Location: expenses.php");
	}
	else
	{
		?>
        <script>alert('Username / Password Seems Wrong !');</script>
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
<td><input type="text" name="email" placeholder="E-mail" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Parola" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-login">Autentificare</button></td>
</tr>
<tr>
<td><a href="register.php">Inregistrare</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>