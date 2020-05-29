<?php
//gives details of group with given group id
session_start();
include('../includes/config.php');

$q = $_GET['q'];

$query = "SELECT * FROM groups WHERE id = '$q' LIMIT 1";
$result = mysqli_query($con, $query);

$rows = mysqli_num_rows($result);
$r = mysqli_fetch_assoc($result);

echo json_encode($r);

?>