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
        	hi' <a href = "accountSettings.php" ><?php echo $userRow['EMAIL']; ?> </a> &nbsp;<a href="logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>    
<?php include 'menu.html';?>
<div id="body">
    
   <form action="exportUserExpenses.php" method="POST">
        <fieldset>
            <legend>Export detail:</legend>
             <table>
                <tbody>
                    <tr>
                        <td>Data inceput</td>
                        <td><input type="date" name="startDate" value=<?php echo $maxDate; ?> max=<?php echo $maxDate; ?> required></td>
                    </tr>
                    <tr>
                        <td>Data sfarsit</td>
                        <td><input type="date" name="endDate" value=<?php echo $maxDate; ?> max=<?php echo $maxDate; ?> required></td>
                    </tr>
                    <tr>
                        <td>Tipul raportului:</td>
                        <td>
                            <select name="reporttype">
                                <option value="xml">XML</option>
                                <option value="json">JSON</option>
                                <option value="html">HTML</option>
                            </select>
                        </td>
                    </tr>
                </tbody>    
            </table>
        </fieldset>
         <input type="submit" value="Descarca raport">
    </form>
</div>

</body>
</html>