<?php  
include 'connection.php';
include 'getdata.php';

$input = filter_input_array(INPUT_POST);
$id = (int)($input['id']) - 1;
$id = (int)$user->transactionId[$id];

if ($input['action'] === 'edit') {
    $link->query("UPDATE transactions SET transactionAmount='" . $input['amount'] . "', idCategory='" . $input['category'] . "', idPayment='" . $input['payment'] . "', transactionDate='" . $input['date'] . "' WHERE idTransaction='" . $id . "'");
} else if ($input['action'] === 'delete') {
    $link->query("DELETE FROM transactions WHERE idTransaction='" . $id . "'");
}
	
?>