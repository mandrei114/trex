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
$filename ="results.json";
$ext = substr($filename, strpos($filename,'.')+1);

$sql="select CA.CATEGORY_NAME, CA.CATEGORY_DESCRIPTION, EX.EXPENSE_DATE, EX.AMOUNT, EX.DESCRIPTION from EXPENSE EX join CATEGORY CA ON EX.FK_CATEGORY = CA.ID_CATEGORY".
" WHERE EX.FK_USER = ".$_SESSION['user']." order by EX.FK_CATEGORY ASC, EX.EXPENSE_DATE ASC";


$response = array();
$expenses = array();
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)) 
{ 
	$categoryname=$row['CATEGORY_NAME']; 

	$categorydescription=$row['CATEGORY_DESCRIPTION']; 

	$expensedate=$row['EXPENSE_DATE'];

	$expenseamount=$row['AMOUNT'];

	$expensedescription=$row['DESCRIPTION'];
	
	$expenses[] = array('categoryName'=> $categoryname, 'categoryDescription'=> $categorydescription, 'expenseDate' => $expensedate, 'expenseAmount' => $expenseamount, 'expenseDescription' => $expensedescription);

} 

$response['expenses'] = $expenses;

$fp = fopen($filename, 'w');
fclose($fp);

header('Content-disposition: attachment; filename='.$filename);

if(strtolower($ext) == "txt")
{
    header('Content-type: text/plain'); // works for txt only
}
else
{
    header('Content-type: application/'.$ext); // works for all extensions except txt
}
readfile($filename);
?> 
