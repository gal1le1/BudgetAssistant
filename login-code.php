<?php  
include 'connection.php';
session_start();

if(isset($_POST["do_login"])){

$username = $password = $pwd = "";

$username = $_POST["username"];
$pwd = $_POST["password"];
$password = MD5($pwd);

$username = $link->real_escape_string($username);

$sql = "SELECT * FROM customers WHERE username = '$username' AND password = '$password'";
$result = $link->query($sql);

if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$id = $row["user_id"];
		$username = $row["username"];

		$_SESSION["id"] = $id;
		$_SESSION["username"] = $username;
	}
	echo "success";
}
else
{
	echo "fail";
}
exit();

}


?>