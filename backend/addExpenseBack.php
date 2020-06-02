<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['id'])){
	header('Location: index.php');
	die();
}

include('../includes/config.php');

if(isset($_POST['amtSubmit'])){

	$fname = 'USER';
	$id = $_SESSION['id'];

	if(!empty($_SESSION['name'])){
		$fname = $_SESSION['name'];
    }

    $g = mysqli_real_escape_string($con, $_POST['grpID']);
    $amount = mysqli_real_escape_string($con, $_POST['amtt']);

    $g_arr = explode('/', $g);
    $g_ID = $g_arr[0];
    $gname = $g_arr[1];

    $q1 = "SELECT assets FROM groups WHERE id='$g_ID' OR gname='$gname' ";
    $r1 = mysqli_query($con, $q1);
    $rows1 = mysqli_num_rows($r1);
    if($rows1>=1){

    	$arr1 = mysqli_fetch_assoc($r1);
    	$prev_assets = (int)$arr1['assets'];

    	$new_assets = $prev_assets + (int)$amount;
    	$u1 = "UPDATE groups SET assets='$new_assets' WHERE id='$g_ID' OR gname='$gname'";
        $ur1 = mysqli_query($con,$u1);
        if($ur1>=1){

        	$q2 = "SELECT expense FROM expensetable WHERE group_id='$g_ID' AND member_id='$id' AND is_active='1' LIMIT 1";
        	$r2 = mysqli_query($con, $q2);
        	$rows2 = mysqli_num_rows($r2);
        	if($rows2>=1){

        		$arr2 = mysqli_fetch_assoc($r2);
        		$prev_expense = (int)$arr2['expense'];

        		$new_expense = $prev_expense+(int)$amount;
        		$u2 = "UPDATE expensetable SET expense='$new_expense' WHERE group_id='$g_ID' AND member_id='$id' AND is_active='1' ";
        		$ur2 = mysqli_query($con,$u2);
        		if($ur2>=1){

        			$msg = $fname." Added ₹ ".$amount." Updated Contribution = ₹".$new_expense." ";
        			$msg_query = "INSERT INTO group_chats(group_id,gname,member_id,member_name,message,dttime) VALUES ('$g_ID','$gname','$id','$fname','$msg',NOW()) ";
        			$msg_r = mysqli_query($con,$msg_query);
        			if($msg_r>=1){
        				echo "<script> alert('₹".$amount." Added To ".$gname." Successfully ');window.open('../groupDetails.php?q=".$g_ID."','_self'); </script>";
        			}
        			else{
        				echo "<script> alert('Error In message');window.open('../index.php','_self'); </script>";
        			}

        		}
        		else{
        			echo "<script> alert('Error In Expense');window.open('../index.php','_self'); </script>";
        		}

        	}
        	else{
        		echo "<script> alert('Error In Expense');window.open('../index.php','_self'); </script>";
        	}

        }
        else {
        	echo "<script> alert('Error In group');window.open('../index.php','_self'); </script>";	
        }
    }
    else{
    	echo "<script> alert('Error In group');window.open('../index.php','_self'); </script>";
    }

}
else {
	header("Location: index.php");	
}

?>