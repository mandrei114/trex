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
    $category = $_POST['category'];
    debug_to_console($category);
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
            <fieldset class="center-fieldset">
                <legend>Date categorie:</legend>
                <table>
                    <tbody>
                        <tr>
                            <td>Categorie parinte :</td>
                            <td><select name="category">
                                <option value=""></option>
                                <?php
                                $categories = mysql_query("SELECT * FROM CATEGORY WHERE ID_PARENT IS NULL ORDER BY CATEGORY_NAME");
                                while($row = mysql_fetch_assoc($categories)) {
                                    echo "<option value={$row['ID_CATEGORY']}>{$row['CATEGORY_NAME']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Nume categorie:</td>
                        <td><input type="text" name="categoryname" required></td>
                    </tr>
                    <tr>
                        <td>Descriere:</td>
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