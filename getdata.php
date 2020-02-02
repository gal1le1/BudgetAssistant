<?php  
include 'connection.php';
session_start();

if(!isset($_SESSION["id"]))
{
    // not logged in
    header('Location: login.php');
    exit();
}

/**
 * User's data 
 */
class User
{	
	public $userId;
	public $row_count;
	public $balance;
	public $multiplierCoefficient = array();
	public $transactionId = array();
	public $transactionAmount = array();
	public $transactionDate = array();
	public $category = array();
	public $payment = array();
}
$user = new User();
$user->userId = $_SESSION["id"];

$sqlSelectAll = "SELECT accounting.multiplierCoefficient, transactions.idTransaction, transactions.transactionAmount, transactions.transactionDate, categories.category, payments.paymentMethod FROM transactions, payments, categories, accounting WHERE transactions.user_id = ". $user->userId." AND transactions.idCategory = categories.idCategory AND transactions.idPayment = payments.idPayment AND categories.idAccounting = accounting.idAccounting ORDER BY transactions.transactionDate DESC" ;

$result = $link->query($sqlSelectAll);
$user->row_count = $result->num_rows;
$i=0;
$user->balance = 0;

while ($var = $result->fetch_assoc()) {
	$user->balance = $user->balance + (float)($var["transactionAmount"])*(int)($var["multiplierCoefficient"]);
	$user->transactionId[$i] = $var["idTransaction"];
	$user->transactionAmount[$i] = $var["transactionAmount"];
	$user->transactionDate[$i] = $var["transactionDate"];
	$user->category[$i] = $var["category"];
	$user->payment[$i] = $var["paymentMethod"];
	$i+=1;
}

$sqlPaymentStat = "SELECT idPayment FROM `transactions` WHERE user_id = ". $user->userId ." ORDER BY idPayment ASC";

$resultPayment = $link->query($sqlPaymentStat);
$paymentStat = array();
$paymentStat = array_fill(0, 5, 0);

while ($var = $resultPayment->fetch_assoc()) {
	$paymentStat[(int)($var["idPayment"])] += 1;
}

$sqlCategoryStat = "SELECT idCategory, transactionAmount FROM `transactions` WHERE user_id = ". $user->userId ." ORDER BY idCategory ASC ";

$resultCategory = $link->query($sqlCategoryStat);
$categoryStat = array();
$categoryStat = array_fill(0, 16, 0);

while ($var = $resultCategory->fetch_assoc()) {
	$categoryStat[(int)($var["idCategory"])] += (int)($var["transactionAmount"]);
}

?>