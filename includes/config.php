<?php
$dbuser = "root";
$dbpass = "";
$host = "localhost";
$db = "webster";
$con = mysqli_connect($host,$dbuser,$dbpass) OR die("Connection Couldn't Be Established :/");
mysqli_select_db($con,$db);
?>
