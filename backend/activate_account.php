<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['id'])){
	header('Location: index.php');
	die();
}

include('../includes/config.php');

if(isset($_GET['k']) && isset($_GET['inv'])){


	$invited_id = trim($_GET['inv']);
	$key = trim($_GET['k']);

	if($invited_id != $_SESSION['id']){
		echo "<script>alert('Please Login First !!');window.open('../index.php','_self');</script>";
	}
	else{

		$lid = $_SESSION['id'];

		$query = "SELECT * FROM expensetable WHERE member_id='$lid' AND activate_key='$key' AND is_active='0' ";
		$q_result = mysqli_query($con,$query);
		$q_rows = mysqli_num_rows($q_result);
		if($q_rows>=1)
		{
			$arr_result = mysqli_fetch_array($q_result);
			$r_gname = $arr_result['gname'];
			$r_gid = $arr_result['group_id'];


			$u1 = "UPDATE `expensetable` SET `is_active`='1' WHERE group_id='$r_gid' AND member_id='$lid' AND activate_key='$key' ";
			$u_result = mysqli_query($con,$u1);
			if($u_result==1){

				$select_grp = "SELECT * FROM groups WHERE id='$r_gid' ";
				$select_result = mysqli_query($con,$select_grp);
				$select_rows = mysqli_num_rows($select_result);
				$select_arr = mysqli_fetch_array($select_result);

				$memCount = (int)$select_arr['membersCount'];
				$memCount = $memCount + 1 ;
				print_r($select_arr['membersCount']);
				print_r($r_gname);
				print_r($r_gid);

				if($select_rows>=1){

					$update_2 = "UPDATE `groups` SET membersCount='$memCount' WHERE id='$r_gid' AND gname='$r_gname' ";
					// $u2 = "UPDATE `groups` SET `membersCount`=$memCount WHERE id='r_gid'";
					$update2_result = mysqli_query($con,$update_2);
					if($update2_result==1){
						$msg = $_SESSION['name']." Joined Group ".$r_gname." 🤗 ";
						$fname = $_SESSION['name'];
						$c1 = "INSERT INTO group_chats (group_id, gname, member_id, member_name, message, dttime ) VALUES ('$r_gid','$r_gname','$lid','$fname','$msg',NOW()) ";
						$c_result = mysqli_query($con,$c1);
						if($c_result==1){
							 echo "<script>alert('Your Account Is Now Acivated in Group ".$r_gname." !! ');window.open('../index.php','_self');</script>";
						}
						else{
							echo "<script>alert('Error Activating Try Again 3');window.open('../index.php','_self');</script>";
						}

					}
					else{
						echo "<script>alert('Error Activating Try Again 2');window.open('../index.php','_self');</script>";	
					}
				}
				else{
					echo "<script>alert('Error Activating Try Again 1');window.open('../index.php','_self');</script>";
				}
			}
			else{
				echo "<script>alert('Error Activating Try Again 1');window.open('../index.php','_self');</script>";	
			}
		}
		else{
			echo "<script>alert('Either Activated Or Invitation Not Received Properly');window.open('../index.php','_self');</script>";	
		}

	}

}

?>

