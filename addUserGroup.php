<?php
session_start();
include_once 'dbconnect.php';
include_once 'helper.php';
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
    $categoryId = $_POST["categoryId"];
    $userId = $_SESSION['user'];
    mysql_query("INSERT INTO EXPENSE(EXPENSE_DATE, AMOUNT, DESCRIPTION, FK_CATEGORY, FK_USER) VALUES('$expensedate', $expensevalue, '$description', $categoryId, $userId)");
    debug_to_console("INSERT INTO EXPENSE(EXPENSE_DATE, AMOUNT, DESCRIPTION, FK_CATEGORY, FK_USER) VALUES('$expensedate', $expensevalue, '$description', $categoryId, $userId)");
    header('Location: expenses.php');
    exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div id="body">
    <form action="addUserGroup.php" method="POST">
        <fieldset>
            <legend>Detalii grup:</legend>
             <table>
                <tbody>
                    <tr>
                        <td>Nume grup:</td>
                        <td><input type="text" name="groupname"></td>
                    </tr>
                    <tr>
                        <td>Descriere grup:</td>
                        <td><input type="text" name="groupdescription"></td>
                    </tr>
                </tbody>    
            </table>
        </fieldset>
         <input type="submit" value="Salveaza grup">
    </form>
    
</form>
</div>

</body>
</html>