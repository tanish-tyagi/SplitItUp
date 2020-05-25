<?php

session_start();
if(isset($_SESSION['id'])){
	session_destroy();
	echo "<script>alert('Logged Out Successfully ');window.open('../index.php','_self');</script>";
}
else
{
	echo "<script>window.open('../index.php','_self');</script>";
}

?>