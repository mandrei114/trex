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
    <form action="addCategoryExpense.php" method="POST">
        <fieldset>
            <legend>Expense data:</legend>
             <table>
                <tbody>
                    <tr>
                        <td>Categorie:</td>
                        <td><select name="categoryId">
                            <?php
                                $categories = mysql_query("SELECT * FROM CATEGORY ORDER BY CATEGORY_NAME");
                                while($row = mysql_fetch_assoc($categories)) {
                                    echo "<option value={$row['ID_CATEGORY']}>{$row['CATEGORY_NAME']}</option>";
                                }
                            ?>
                        </select></td>
                    </tr>
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