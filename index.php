<?php
session_start();
if ($_SESSION[user_login] == 'admin') {
	$access = true;
}
require_once "connect.php";
?>

<html>
	<head>
	<meta charset="utf-8">
	<title>Texode</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="valid.js"></script>
	</head>
	<body>
	
	
	<div class="auth">
		<form method="post" name="auth" action="auth.php">
		
			<label for="name">Login</label>
			<input type="text" name="login" id="login">
			
			<label for="name">Password</label>
			<input type="password" name="password" id="password">
			
			<input type="submit" value="вход">
		
		</form>
	</div>
	
	
	<h2>Отзывы</h2><!--ASC DESC-->
	
	
	
	<div class="sort">
	<p>Сотритровать отзывы по: 
	
	<a href="<? 
	if ($_GET['sort'] != 'nameASC') {
		echo '?sort=nameASC';
	} else if ($_GET['sort'] != 'nameDESC')  {
		echo '?sort=nameDESC';
	}
	?>">Имени</a>
	
	<a href="<? 
	if ($_GET['sort'] != 'emailASC') {
		echo '?sort=emailASC';
	} else if ($_GET['sort'] != 'emailDESC')  {
		echo '?sort=emailDESC';
	}
	?>">Е-mail</a> 
	
	<a href="<? 
	if ($_GET['sort'] != 'dateASC') {
		echo '?sort=dateASC';
	} else if ($_GET['sort'] != 'dateDESC')  {
		echo '?sort=dateDESC';
	}
	?>">Дате</a> 
	</p>
	</div>
	
	
	
		
		<?php 
		//сортировка
		
		$sort = 'ORDER BY user_date DESC';
		
		if ($_GET['sort'] == 'dateASC') {
			$sort = 'ORDER BY user_date ASC';
		} else if ($_GET['sort'] == 'dateDESC') {
			$sort = 'ORDER BY user_date DESC';
		}
		
		if ($_GET['sort'] == 'emailASC') {
			$sort = 'ORDER BY user_email ASC';
		} else if ($_GET['sort'] == 'emailDESC') {
			$sort = 'ORDER BY user_email DESC';
		}
		
		if ($_GET['sort'] == 'nameASC') {
			$sort = 'ORDER BY user_name ASC';
		} else if ($_GET['sort'] == 'nameDESC') {
			$sort = 'ORDER BY user_name DESC';
		}
		
		//удаление
		
		if ($_GET['delete']) {
			$numdel = $_GET['delete'];
			
			connectDB();
			mysqli_query($mysqli, "DELETE FROM `feedback` WHERE `user_id` = $numdel");
			closeDB();
			
		}
		
		
		
		
		
		
		
		
		connectDB();
		
		$query = mysqli_query($mysqli, "SELECT * FROM `feedback` $sort");
		
		
		 while($row=mysqli_fetch_array($query)) {
			 
			 if ($access) {
			 $delete_num = $row[user_id];
			 $delete = "<a href=\"?delete=$delete_num\">Удалить</a>";
			 }
			 
			 echo "<link rel='stylesheet' href='style.css'>";
			 
			 echo "
			 
			 
			 
			 
			 <div class='post'>
			 
				 <img src='$row[user_foto]' class='user_foto'>
				 
				 <div class='user_info'
					 <p class='user_name'>$row[user_name]</p>
					 <p class='user_text'>$row[user_text]</p>
					 <p class='user_email'>$row[user_email]</p>
					 <p class='user_date'>$row[user_date]</p>
				 </div>
				 
				$delete
				
				 
				 <div class='clearfix'></div>
			 
			 </div>
			 ";
			}
		
		closeDB();
		
		?>
		
		
		
		
		
		
		
		
		
		
		
		
		
	
		<h3>Форма обратной связи</h3>
		<form method="post" action="feedback.php" enctype="multipart/form-data" name="form_feedback" class="feedbackForm">
		<div class="form_float">
		
			<div class="field">
			<label for="name">Имя</label>
			<input type="text" name="name" id="name" maxlength="50">
			</div>
			
			<div class="field">
			<label for="email">Email</label>
			<input type="email" name="email" id="email"><!--type email -->
			</div>
			
			<div class="field">
			<label for="textarea">
			<p>Тескт отзыва</p><!--200 сим сделать -->
			<textarea rows="10" cols="50" name="textarea" id="textarea"></textarea>
			</label>
			</div>
			
			<div class="field">
			<label for="foto">Автар в формате jpg, gif или png</label>
			<input type="file" name="foto" accept="image/JPG, image/GIF, image/PNG">
			</div>
			
			<div class="field">
			<input type="submit" class="submitButton">
			
			<p class="error_message_p">-</p>
			</div>
			
		</div>
		
		</form>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	</body>

</html>