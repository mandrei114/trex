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
    debug_to_console("caught post, calling addCategoryExpense()");
    addCategoryExpense();
}
$today = date("Y-m-d");
$maxDate = '"'.$today.'"';

function addCategoryExpense(){
    $expensevalue = $_POST["expensevalue"];
    $expensedate = $_POST["expensedate"];
    $description = htmlspecialchars($_POST["description"]);
    $userId = $_SESSION['user'];
    mysql_query("INSERT INTO EXPENSE(EXPENSE_DATE, AMOUNT, DESCRIPTION, FK_CATEGORY, FK_USER) VALUES('$expensedate', $expensevalue, '$description', 1, $userId)");
    debug_to_console("INSERT INTO EXPENSE(EXPENSE_DATE, AMOUNT, DESCRIPTION, FK_CATEGORY, FK_USER) VALUES('$expensedate', $expensevalue, '$description', 1, $userId)");
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
           hi' <a href = "accountSettings.php" ><?php echo $userRow['EMAIL']; ?> </a> &nbsp;<a href="logout.php?logout">Sign Out</a>
       </div>
   </div>
</div>

<?php include 'menu.html';?>

<div id="body">
    <form action="addCategoryExpense.php" method="POST">
        <fieldset>
            <legend>Expense data:</legend>
             <table>
                <tbody>
                    <tr>
                        <td>Expense value (min. 1):</td>
                        <td><input type="number" name="expensevalue" min="1" step="0.1"></td>
                    </tr>
                    <tr>
                        <td>Enter a date for the expense:</td>
                        <td><input type="date" name="expensedate" value=<?php echo $maxDate; ?> max=<?php echo $maxDate; ?> required></td>
                    </tr>
                    <tr>
                        <td>Enter a description:</td>
                        <td><textarea rows="4" cols="50" name="description"></textarea></td>
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