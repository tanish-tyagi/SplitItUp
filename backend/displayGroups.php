<?php
//gives list of groups for any person with given id
session_start();
include('../includes/config.php');

$q = $_GET['q'];

$query = "SELECT * FROM expensetable WHERE member_id = '$q' ";
$result = mysqli_query($con, $query);

$rows = mysqli_num_rows($result);
$arr = array();
while($rows--){
	$r = mysqli_fetch_assoc($result);
	array_push($arr,$r);
}

echo json_encode($arr);

?>