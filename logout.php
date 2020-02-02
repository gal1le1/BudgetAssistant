<?php  
session_start();
$username = $_SESSION['username'];
unset($_SESSION['username']);
unset($_SESSION['id']);
session_destroy();
header("Location: login.php");
exit();
if(!isset($_SESSION['username'])) //If user is not logged in then he cannot access the profile page
{
	header("location:login.php");
}


?>