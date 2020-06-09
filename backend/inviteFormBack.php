<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['id'])){
	header('Location: index.php');
	die();
}

include('../includes/config.php');

if(isset($_POST['inviteSubmit'])){

	$fname = 'USER';
	$id = $_SESSION['id'];

	if(!empty($_SESSION['name'])){
		$fname = $_SESSION['name'];
    }

	$inv_gid_temp = mysqli_real_escape_string($con, $_POST['inv_gid']);
	$inv_gid_arr = explode('/', $inv_gid_temp);
	$invited_id = $inv_gid_arr[1];
	$inv_gid = $inv_gid_arr[0];

	if(empty($invited_id)){
		echo "<script>alert('Invalid Input');window.open('../index.php','_self')</script>";
		exit();
	}
	if(empty($inv_gid)){
		echo "<script>alert('Invalid Input');window.open('../index.php','_self')</script>";
		exit();
	}

	$q11 = "SELECT * FROM expensetable WHERE group_id='$inv_gid' AND member_id='$invited_id' LIMIT 1";
	$r11 = mysqli_query($con, $q11);
	$rows11 = mysqli_num_rows($r11);

	if($rows11 >= 1){
		echo "<script>alert('This User Is Already Member Of Ur Group 😅');window.open('../index.php','_self')</script>";
	}else{

		$q21 = "SELECT name,email FROM users WHERE id='$invited_id'";
		$r21 = mysqli_query($con, $q21);
		$arr21 = mysqli_fetch_array($r21);

		$inv_name = $arr21['name'];
		$inv_email = $arr21['email'];

		$q31 = "SELECT gname, membersCount FROM groups WHERE id='$inv_gid'";
		$r31 = mysqli_query($con, $q31);
		$arr31 = mysqli_fetch_array($r31);

		$inv_gname = $arr31['gname'];
		$inv_count = $arr31['membersCount'];
		$activate_key = rand(1,1000000);

		$q41 = "INSERT INTO expensetable(group_id, gname, member_id, member_name, expense, is_active, activate_key) VALUES ('$inv_gid','$inv_gname','$invited_id','$inv_name','0','0','$activate_key') ";
		$r41 = mysqli_query($con, $q41);
		if(mysqli_affected_rows($con)>=1){

			$server_id = $_SERVER['SERVER_NAME'];
			$link = $server_id."/Ganesh%20Ji/backend/activate_account.php?k=$activate_key&inv=$invited_id";

			$to = $inv_email;
			$to_name = $inv_name;
			$from = $_SESSION['email'];
			$from_name = $fname;
			$subject = "Activate Your SplitItUp Account";
			$body = "<html><head></head><body>
			<h2>Hello ".$inv_name.", You Are Invited By Creator Of Group-'".$inv_gname."' To Join Them.</h2><br>
			<a href='".$link."' >Click Here To Activate Your Account In Group -> ".$inv_gname."</a><p>Or go to this link-- '".$link."'</p></body></html>";
			$alt_body = "This Message is delivered by SplitItUp Team";
			include("../sendInvitationMail.php");
			echo('<script>alert("'.$inv_name.' Is Invited To Your Group '.$inv_gname.'");window.open("../index.php","_self");</script>');

		}
		else{
			echo "<script>alert('Error Inviting Member');window.open('../index.php','_self')</script>";
		}
	}

}


?>