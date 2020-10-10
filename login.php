<?php 

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

	if($_POST['username'] == "devin" && $_POST['password'] == 'ddddd') {

		$_SESSION['is_logged_in'] = true;
		header("Location: index.php");

	} else {

		$error = "login incorrect";
	}
}

 ?>

 <?php require "includes/header.php"; ?>

 <h2><i>LOGIN</i></h2>

 <?php if(!empty($error)): ?>
 	<p><?=htmlspecialchars($error);?></p>
 <?php endif; ?>

 <form method="post">
 	<div>
 		<label for="username">Username:&nbsp;</label>
 		<input type="text" name="username" id="username" placeholder="Enter Username" value="">
 	</div>
 	<div>
 		<label for="password">Password:&nbsp;</label>
 		<input type="password" name="password" id="password" placeholder="Enter password">
 	</div>
 	<div>
 		<br><button>LOGIN</button>
 	</div>
 </form>

 <?php require "includes/footer.php"; ?>