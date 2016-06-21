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
    echo "<table id=\"expTable\">";
    echo "<th>Nume categorie<th>";
    echo "<th>Descriere categorie<th>";
    echo "<th>Data cheltuiala<th>";
    echo "<th>Suma cheltuita<th>";
    $res=mysql_query("select * from expense ex join category ca on ex.fk_category = ca.id_category where ex.fk_user = ".$_SESSION['user']);
    $idIndex = 1;
    while($row = mysql_fetch_assoc($res))
    {
       
        echo "<tr id=".$idIndex.">";
        
        echo "<td>{$row['CATEGORY_NAME']}<td>";
        echo "<td>{$row['CATEGORY_DESCRIPTION']}<td>";
        echo "<td>{$row['EXPENSE_DATE']}<td>";
        echo "<td>{$row['AMOUNT']}<td>";
        $idIndex = $idIndex+1;
        echo "</tr>";
    }
    echo "</table>";
    
?>

<dialog id="window">
    <?php
        include_once 'addCategoryExpense.php';
    ?>
    
    <button id="exit">Exit</button>
</dialog>
<button id="show">Show Dialog</button>
<script>
document.getElementById("show").addEventListener("click", showDialog);
document.getElementById("exit").addEventListener("click", hideDialog);

function showDialog() {
    document.getElementById("window").show();
}
function hideDialog() {
    document.getElementById("window").close();
}
</script>

</div>


   


</body>
</html>