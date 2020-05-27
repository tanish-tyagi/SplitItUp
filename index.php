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
	    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	    <title>SplitItUp :: Homepage</title>
	    <?php include('includes/head_files.html'); ?>
	    <link rel="stylesheet" type="text/css" href="css/forms.css">
	</head>
	<body>
		<?php include('includes/header.php'); ?>
		<div class="container" style="padding: 25px;">
			<!-- <div class="row collapse" id="ccHome">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<?php// include('includes/cc_home.php');?>
				</div>
				<div class="col-md-3"></div>
			</div> -->
			<div class = "row">
				<div class="col-md-6">
					<h2>LOGIN</h2>
					<form action="backend/login.php" method="post">
						<div class="form-label-group">
							<input type="E-Mail" id="emailLogin" name="email" autocomplete="off" class="form-control" placeholder="E-Mail" required autofocus>
							<label for="emailLogin">E-Mail</label>
						</div>
						<div class="form-label-group">
							<input type="Password" name="password" id="passLogin" autocomplete="off" class="form-control" placeholder="Password" required>
							<label for="passLogin">Password</label>
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
						<div class="form-label-group">
							<input type="text" id="nameSignUp" name="name" autocomplete="off" class="form-control" placeholder="Full Name" required>
							<label for="nameSignUp">Full Name</label>
						</div>
						<div class="form-label-group">
							<input type="E-Mail" name="email" id="emailSignUp" autocomplete="off" class="form-control" placeholder="E-Mail" required>
							<label for="emailSignUp">E-Mail</label>
						</div>
						<div class="form-label-group">							
							<input type="Password" name="password" id="passSignUp" autocomplete="off" class="form-control" placeholder="Password" required>
							<label for="passSignUp">Password</label>
						</div>
						<div class="form-label-group">							
							<input type="Password" name="confirm_password" id="cPassSignUp" autocomplete="off" class="form-control" placeholder="Confirm Password" required>
							<label for="cPassSignUp">Confirm Password</label>
						</div>
						<div class="form-group">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleRadio" value="M">
								<label class="form-check-label" for="maleRadio">Male</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleRadio" value="F">
								<label class="form-check-label" for="femaleRadio">Female</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="inlineRadioOptions" id="othersRadio" value="O">
								<label class="form-check-label" for="othersRadio">Other</label>
							</div>
						</div>
						<div class="form-group">
							<!-- <label>Upload Profile Pic (Max Size Limit: 10MB)</label>
							<input type="file" name="picFile" autocomplete="off" class="form-control"> -->
							<div class="input-group mb-3">
							   <div class="input-group-prepend">
							    <span class="input-group-text" id="inputGroupFileAddon01">Upload Profile Pic</span>
							   </div>
							  <div class="custom-file">
							    <input type="file" name="picFile" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
							    <label class="custom-file-label" for="inputGroupFile01">Choose Pic (Size Limit: 10MB)</label>
							  </div>
							</div>
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
		<?php include('includes/footer.php');?>
	</body>
</html>