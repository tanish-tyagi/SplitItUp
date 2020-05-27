<?php

session_start();
include('../includes/config.php');

$name = "";
$email = "";
$file = "";

if(isset($_SESSION['id'])){
	header('location: ../home.php');
	die();
}
if(isset($_POST['signup']))
{
	/*Captcha Verification
	*
	*
	*
	*End
	*/

	//Variables Declaration
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$conf_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
	$gender = mysqli_real_escape_string($con, $_POST['inlineRadioOptions']);


	$errors = array();
	$message = "";


	//Validation
	if(empty($name)) {array_push($errors, "Name is Required");}
	if(empty($email)) {array_push($errors, "Email is Required");}
	if(empty($password)) {array_push($errors, "Password is Required");}
	if(empty($gender)) {array_push($errors, "Gender Not Selected");}

	if($password != $conf_password){array_push($errors, "Password Mismatch");}
	if(strlen($password)<4){array_push($errors, "Password is too short");}
	if(strlen($password)>50){array_push($errors, "Password is too long");}

	include('../backend/pic_upload.php');

	//User check
	$user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
	$user_check_query_results = mysqli_query($con, $user_check_query);
	$user = mysqli_fetch_assoc($user_check_query_results);
	if($user)
	{
		if($user['email']===$email){array_push($errors, "This E-Mail is already registered");}
	}

	//Register the user if no error
	if(count($errors)===0){

		$hashed_pass = md5($password); // Hashing the password
		$fileNewName = "profileDefault.jpg";
		if($_FILES['picFile']['error']===0){
			$fileNewName = 'profile'.md5($email).'.'.$fileActualExt;
			$fileDest = '../uploads/'.$fileNewName;
			move_uploaded_file($fileTmpName, $fileDest);
		}

		$insert_query = "INSERT INTO users(name, email, password, profile_pic, gender, date_created, last_accessed) VALUES ('$name','$email','$hashed_pass', '$fileNewName', '$gender', NOW(), NOW())";
		$insert_query_result = mysqli_query($con, $insert_query);
		if($insert_query_result){
		echo "<script>alert('Account Created Successfully ');window.open('../index.php','_self');</script>";
		}
	}
	else{
		$_SESSION['signup_error'] = $errors;
		header('location: ../index.php');
	}

	
}

?>