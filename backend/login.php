<?php

session_start();


include('../includes/config.php');

if(isset($_SESSION['id'])){
	echo "<script>alert('Already Logged In');window.open('../home.php','_self')</script>";
	// header('location: home.php');
	die();
}

$email = "";
$password = "";

$errors = array();

if(isset($_POST['login']))
{


	// Variable Declaration
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);

	//Validate
	if(empty($email)){array_push($errors, "Please provide email");}
	if(empty($password)){array_push($errors, "Please provide password");}
	if(strlen($password)>100 || strlen($password)<4){array_push($errors, "Invalid Input Length");}

    $name = "Tanish";
	if(empty($errors)){

		$hashed_pass = md5($password);
		$user_search_query = "SELECT email, password FROM users WHERE email= ? ";
		$stmt = mysqli_prepare($con, $user_search_query);
		mysqli_stmt_bind_param($stmt, 's', $paramEmail);
		$paramEmail = $email;
		$paramPass = "";
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		if(mysqli_stmt_num_rows($stmt)===1){

			mysqli_stmt_bind_result($stmt, $paramEmail, $paramPass);
			if(mysqli_stmt_fetch($stmt)){

				if($hashed_pass === $paramPass) //Matching Password
				{

					$query = "SELECT * FROM users WHERE email='$paramEmail' AND password='$paramPass' ";

					$result = mysqli_query($con, $query);
					if(mysqli_num_rows($result)){
						$arr = mysqli_fetch_array($result);

						$_SESSION['id'] = $arr['id'];
						$id = $arr['id'];
						$_SESSION['name'] = $arr['name'];
						$_SESSION['email'] = $arr['email'];
						$_SESSION['last'] = $arr['last_accessed'];
						$_SESSION['pic'] = $arr['profile_pic'];

						$update_query = "UPDATE `users` SET `last_accessed`=NOW() WHERE id='$id'";
						$update_result = mysqli_query($con, $update_query);

						echo "<script>alert('Logged In Successfully :)');window.open('../home.php','_self');</script>";
					}
				}
				else // Password Not Matched
				{
					echo "<script>alert('Incorrect Password :(');window.open('../index.php','_self');</script>";
				}
			}
		}
		else // No Account Found
		{
			echo "<script>alert('Incorrect E-Mail OR Not Registered ');window.open('../index.php','_self');</script>";
		}
	}
	else // Some Errors in Input
	{
		$_SESSION['login_error'] = $errors;
		echo "<script>window.open('../index.php','_self');</script>";
	}
}

?>