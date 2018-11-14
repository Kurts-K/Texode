<?php
session_start();
header ('Location: index.php');
require_once "connect.php";

connectDB();

$login = trim(htmlspecialchars(stripslashes($_POST['login']))); 
$password = trim(htmlspecialchars(stripslashes($_POST['password'])));



$query_user = mysqli_query($mysqli, "SELECT * FROM `users` WHERE user_login='$login'");
$data = mysqli_fetch_array($query_user);


if ($data[user_password] == $password) {
	$_SESSION[user_login] = $data[user_login];
}









?>