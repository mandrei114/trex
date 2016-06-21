<?php
session_start();
include_once 'dbconnect.php';
include_once 'helper.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM user WHERE id_user=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    changePersonalDetails();
}

function changePersonalDetails(){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];

    $password = $_POST["password"];
    $confirmation = $_POST["confirmation"];

    debug_to_console($firstname);
    debug_to_console($lastname);
    debug_to_console($password);
    debug_to_console($confirmation);

    $userId = $_SESSION['user'];
    if($firstname != "" && $firstname != $userRow['FIRST_NAME']){
        mysql_query("UPDATE USER SET FIRST_NAME = '$firstname' WHERE ID_USER=$userId");
    }

    if($lastname != "" && $lastname != $userRow['LAST_NAME']){
        mysql_query("UPDATE USER SET LAST_NAME ='$lastname' WHERE ID_USER='$userId'");
    }

    if($password != "" && $password==$confirmation){
        $hashPassword = md5($password);
        mysql_query("UPDATE USER SET PASSWORD ='$hashPassword' WHERE ID_USER=$userId");
    }

    header('Location: accountSettings.php');
    exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome - <?php echo $userRow['EMAIL']; ?></title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <div id="header">
        <div id="left">
            <label>Trex</label>
        </div>
        <div id="right">
            <div id="content">
                Buna <a href = "accountSettings.php" ><?php echo $userRow['EMAIL']; ?> </a> &nbsp;<a href="logout.php?logout">Delogare</a>
            </div>
        </div>
    </div>
    <?php include 'menu.html';?>
    <div id="body">
        <form action="accountSettings.php" method="POST">
          <fieldset class="center-fieldset">
            <legend>Informatii personale:</legend>
            <table>
                <tbody>
                    <tr>
                        <td>Nume:</td>
                        <td><input type="text" name="firstname" value=<?php echo $userRow['FIRST_NAME']; ?>></td>
                    </tr>
                    <tr>
                        <td>Prenume:</td>
                        <td><input type="text" name="lastname" value=<?php echo $userRow['LAST_NAME']; ?>></td>
                    </tr>
                </tbody>    
            </table>
        </fieldset>

        <fieldset class="center-fieldset">
            <legend>Parola:</legend>
            <table>
                <tbody>
                    <tr>
                        <td>Parola noua:</td>
                        <td><input type="password" name="password" value=""></td>
                    </tr>
                    <tr>
                        <td>Confirmare:</td>
                        <td><input type="password" name="confirmation" value=""></td>
                    </tr>
                </tbody>    
            </table>
        </fieldset>
        <div class="center">
            <input type="submit" value="Confirm">
        </div>      
        
    </form>
</div>
</body>
</html>