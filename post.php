<?php  
include 'connection.php';
session_start();
if(!isset($_SESSION["id"]))
{
    // not logged in
    header('Location: login.php');
    exit();
}

if(isset($_POST["do_submit"])){

$user_id = $_SESSION["id"];
$transactionAmount = $_POST["amount"];
$transactionDate = $_POST["date"];
$idCategory = $_POST["category"];
$idPayment = $_POST["paymentMethod"];

$sql = "INSERT INTO `transactions`(`user_id`, `transactionAmount`, `transactionDate`, `idCategory`, `idPayment`) VALUES (? ,? ,? ,? , ?)";

$stmt = $link->prepare($sql);

$stmt->bind_param('idsii', $user_id, $transactionAmount, $transactionDate, $idCategory, $idPayment);

if($stmt->execute()){
	echo "success";
}
else{
	echo "fail";
}

exit();

}

?>