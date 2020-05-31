<?php

session_start();
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	die();
}

include('../includes/config.php');

if(isset($_POST['chatSubmit'])){

	$fname = 'USER';
	$id = $_SESSION['id'];

	if(!empty($_SESSION['name'])){
		$fname = $_SESSION['name'];
    }

    $grpID = mysqli_real_escape_string($con, $_POST['grpID']);
    $gname = mysqli_real_escape_string($con, $_POST['grpName']);
    $message = $_POST['msg'];

    if(!empty($message)){

    	$query = "INSERT INTO group_chats(group_id, gname, member_id, member_name, message, dttime) VALUES ('$grpID', '$gname', '$id', '$fname', '$message', NOW() ) ";
    	$result = mysqli_query($con, $query);
    	if($result){
    		echo "<script> alert('Message Sent To All Members Successfully');window.open('../groupDetails.php?q=".$grpID."','_self'); </script>";
    	}
    	else{
    		echo "<script> alert('Error');window.open('../groupDetails.php?q=".$grpID."','_self'); </script>";
    	}
    }
    else{
    		echo "<script> alert('Empty');window.open('../groupDetails.php?q=".$grpID."','_self'); </script>";
    	}

}

?>