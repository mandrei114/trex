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
    debug_to_console("caught post, calling addCategory()");
    addCategory();
}
$today = date("Y-m-d");
$maxDate = '"'.$today.'"';

function addCategory(){
    $name = $_POST["categoryname"];
    $description = $_POST["description"];
    $category = $_SESSION['category'];
    $userId = $_SESSION['user'];
    if($category == null || $category ==""){
         mysql_query("INSERT INTO CATEGORY(CATEGORY_NAME, CATEGORY_DESCRIPTION, FK_USER) VALUES('$name', '$description', $userId)");
    }else{
         mysql_query("INSERT INTO CATEGORY(CATEGORY_NAME, CATEGORY_DESCRIPTION, FK_USER, ID_PARENT) VALUES('$name', '$description', $userId, $category)");
    }
   
    header('Location: categories.php');
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
<div id="body">
    <form action="addCategory.php" method="POST">
        <fieldset>
            <legend>Category data:</legend>
             <table>
                <tbody>
                    <tr>
                        <td>Enter name:</td>
                        <td><input type="text" name="categoryname"></td>
                    </tr>
                    <tr>
                        <td>Enter a description:</td>
                        <td><textarea rows="4" cols="50" maxlength="201" name="description"></textarea></td>
                    </tr>
                </tbody>    
            </table>
        </fieldset>
         <input type="submit" value="Submit">
    </form>
    
</form>
</div>

</body>
</html>