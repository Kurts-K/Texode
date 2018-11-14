<?php
header ('Location: index.php');
require_once "connect.php";

connectDB();

$name = trim(htmlspecialchars(stripslashes($_POST['name']))); 
$email = trim(htmlspecialchars(stripslashes($_POST['email'])));
$textarea = trim(htmlspecialchars(stripslashes($_POST['textarea'])));
$date = date("Y-m-d H:i:s");




$file_name = $_FILES['foto']['name'];
$file_type = $_FILES['foto']['type'];
$file_tmp_name = $_FILES['foto']['tmp_name'];
$file_error = $_FILES['foto']['error'];
$file_size = $_FILES['foto']['size'];

if (strlen($file_name) == 0) {
	$avatar_path = 'avatars/noavatar.png';
} else {

$file_name = explode(".", $file_name);
$extension = $file_name[1];
$avatar_path = 'avatars/' . $email . "." . $extension;

}

move_uploaded_file($file_tmp_name, $avatar_path);

$success = $mysqli->query (
"INSERT INTO `feedback` (`user_name`, `user_email`, `user_text`, `user_foto`,    `user_date`, `user_id`) 
			   VALUES ('$name',     '$email',     '$textarea', '$avatar_path',    '$date',        null)"); 

closeDB();
exit;
 
 
 
 
?>



?>