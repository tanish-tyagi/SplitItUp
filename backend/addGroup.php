<?php

session_start();
include('../includes/config.php');

if(!isset($_SESSION['id'])){
	echo "<script> alert('Please Login First'); window.open('../index.php','_self');</script>";
	die();
}

$id = $_SESSION['id'];
$creator = $_SESSION['name'];

if(isset($_POST['gsubmit'])){

	$gname = mysqli_real_escape_string($con, $_POST['gname']);
	$type = mysqli_real_escape_string($con, $_POST['inlineRadioOptions']);

	$errors = array();


	//Validation
	if(empty($id)||empty($creator)){array_push($errors, "Login Error");}
	if(empty($gname)){array_push($errors, "Please Give A Name To Your Group");}
	if(empty($type)){array_push($errors, "Please Select A Type of Group");}

	if(strlen($gname)>50){array_push($errors, "Invalid Input");}
	if(strlen($type)>50){array_push($errors, "Invalid Input");}

	//Group Check
	$check_query = "SELECT * FROM groups WHERE creator_id='$id' AND gname='$gname' AND type='$type' LIMIT 1";
	$check_query_result = mysqli_query($con, $check_query);
	$check_result = mysqli_fetch_assoc($check_query_result);
	if($check_result){array_push($errors, "This Group Already Exists");}


	if(count($errors)===0){		

		// $admin_arr = explode(' ', $creator);
		// $admin = $admin_arr[0].',';
		$count = 1;
		$assets = 0;
		$insert_query = "INSERT INTO groups(gname, creator, creator_id, type, membersCount, assets, date_created) VALUES ('$gname', '$creator', '$id', '$type', '$count', '$assets', NOW())";
		$result = mysqli_query($con, $insert_query);
		if($result){

			$grp_id_query = "SELECT id FROM groups WHERE gname='$gname' AND creator_id='$id' AND type='$type' LIMIT 1";
			$grp_result = mysqli_query($con, $grp_id_query);
			$grp_array = mysqli_fetch_array($grp_result);
			$grp_id = $grp_array['id'];

			if($grp_result){
				$exp_insert = "INSERT INTO expensetable(group_id, gname, member_id, member_name, expense, is_active) VALUES ('$grp_id', '$gname', '$id', '$creator', '$assets', '$count') ";
				$exp_result = mysqli_query($con, $exp_insert);
				if($exp_result){
					echo "<script>alert('Group Created Successfully :) ');window.open('../allGroupsPage.php','_self');</script>";
				}
				else{
					echo "<script>alert('Error In Creating Group');window.open('../home.php','_self');</script>";
				}
			}
			else {
				echo "<script>alert('Error In Creating Group');window.open('../home.php','_self');</script>";
			}
		}
		else{
			echo "<script>alert('Error In Creating Group');window.open('../home.php','_self');</script>";
		}
	}
	else{
		$st = "";
		foreach ($errors as $error){
			$st .= ($error.', ');
		}
		echo "<script>alert('".$st."');window.open('../home.php','_self');</script>";
	}
}

?>