<?php
session_start();
include_once 'dbconnect.php';
include_once 'helper.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
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
        	hi' <?php echo $userRow['EMAIL']; ?>&nbsp;<a href="logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>
    
<?php include 'menu.html';?>
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
<script type="text/javascript">
    prepareList();
</script>
<dialog id="window">
    <button id="exit">Exit</button>
    <?php include_once 'addCategory.php';?>
</dialog>
<button id="add_category">Add category</button>
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