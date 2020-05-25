<?php

session_start();
if(isset($_SESSION['id'])){
	header("location: home.php");
	die();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    <meta name="viewport" content="width-device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	    <title>SplitItUp :: Homepage</title>
	    <?php include('includes/head_files.html'); ?>
	</head>
	<body>
		<?php include('includes/header.php'); ?>
		<div class="container" style="padding: 25px;">
			<div class = "row">
				<div class="col-md-6">
					<h2>LOGIN</h2>
					<form action="backend/login.php" method="post">
						<div class="form-group">
							<label>E-Mail</label>
							<input type="E-Mail" name="email" autocomplete="off" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="Password" name="password" autocomplete="off" class="form-control" required>
						</div>
						<div class="form-group">
						<button type="submit" class="btn btn-primary" name="login"> Login </button>
					    </div>
					    <div class="card alert alert-warning alert-dismissible fade show" role="alert"><?php 
							if(isset($_SESSION['login_error'])){
								$errors = $_SESSION['login_error'];
								echo "<h4 class ='card-title'>Errors:</h4>";
								echo "<div class='card-body'><ul>";
								foreach ($errors as $key) {
									echo "<li><h6>$key</h6></li>";
								}
								echo "</ul></div>";
								unset($_SESSION['login_error']);
							}?>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<h2>SIGNUP</h2>
					<form action="backend/register.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" autocomplete="off" class="form-control" required>
						</div>
						<div class="form-group">
							<label>E-Mail</label>
							<input type="E-Mail" name="email" autocomplete="off" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="Password" name="password" autocomplete="off" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="Password" name="confirm_password" autocomplete="off" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Upload Profile Pic</label>
							<input type="file" name="picFile" autocomplete="off" class="form-control">
						</div>
						<div class="form-group">
						<button type="submit" class="btn btn-primary" name="signup"> SignUp </button>
						<div class="card alert alert-warning alert-dismissible fade show" role="alert"><?php 
							if(isset($_SESSION['signup_error'])){
								$errors = $_SESSION['signup_error'];
								echo "<h4 class ='card-title'>Errors:</h4>";
								echo "<div class='card-body'><ul>";
								foreach ($errors as $key) {
									echo "<li><h6>$key</h6></li>";
								}
								echo "</ul></div>";
								unset($_SESSION['signup_error']);
							}?>
						</div>
					    </div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>