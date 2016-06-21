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
<script type="text/javascript" src="scripts.js">
</script>
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
    <div class="center">
<?php
    echo "<ul id=\"expList\">";
    $res=mysql_query("SELECT * FROM category where id_parent is null");
    $idIndex = 1;
    while($row = mysql_fetch_assoc($res))
    {
        $rowId = $row['ID_CATEGORY'];
        echo "<li id=".$idIndex.">{$row['CATEGORY_NAME']}";
        $idIndex = $idIndex+1;
        $subcategory=mysql_query("SELECT * FROM category where id_parent = {$row['ID_CATEGORY']}");
        echo "<ul id=".$idIndex.">";
        $idIndex = $idIndex+1;
        while($rowsubcategory = mysql_fetch_assoc($subcategory))
        {
            echo "<li id=".$idIndex."> {$rowsubcategory['CATEGORY_NAME']}</li>";
            $idIndex = $idIndex+1;
        }
        echo "</li>";
        echo "</ul>";
    }
    echo "</ul>";
    
?>
    </div>
<script type="text/javascript">
    prepareList();
</script>
<dialog id="window" class="window-content">
    <?php include_once 'addCategory.php';?>
</dialog>
    <div class="center">
    <button id="add_category">Adauga categorie</button>
    </div>
    <script>
document.getElementById("add_category").addEventListener("click", showAddExpenses);
document.getElementById("exit").addEventListener("click", hideDialog);

function showAddExpenses() {
    document.getElementById("window").show();
}
function showAddSubExpenses() {
    document.getElementById("window").show();
}
function hideDialog() {
    document.getElementById("window").close();
}

</script>

</div>


   


</body>
</html>