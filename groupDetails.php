<?php

session_start();
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	die();
}

include('includes/config.php');

$fname = 'USER';
$id = $_SESSION['id'];
$active = 1;

if(!empty($_SESSION['name'])){
	$fname = $_SESSION['name'];
    $farr = explode(' ', $fname);
    $fname = $farr[0];
}

$g = $_GET['q'];

$search_query = "SELECT * FROM expensetable WHERE group_id='$g' AND member_id='$id' AND is_active='$active' LIMIT 1";
$result = mysqli_query($con, $search_query);
if(!(mysqli_num_rows($result)===1)){
	header('Location: home.php');
}
$array = mysqli_fetch_array($result);
$total = $array['expense'];
$gname = $array['gname'];

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	    <title>SplitItUp</title>
	    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
	    <?php include('includes/head_files.html'); ?>
	</head>
	<body>
		<?php include('includes/header_l.php'); ?>
		<div class="container-fluid" style="margin-top: 4rem; ">
			<div class="row">
				<?php include('includes/sidebar_l.php');?>
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="display-4"><?php echo($gname); ?></h1>
						<div class="btn-group btn-group-lg mr-2">
							<button type="button" class="btn btn-sm btn-outline-secondary"
							data-toggle="collapse" data-target="#addExpense" aria-expanded="false" aria-controls="addExpense"><i class="fas fa-plus-circle"></i> Add Expense</button>
            				<button type="button" class="btn btn-sm btn-outline-secondary"><i class="far fa-chart-bar"></i> Your Stats</button>
          				</div>
					</div>
					<!-- Add Expense Form -->
					<div class="collapse" id="addExpense">
  						<div class="card card-body">
  							Add Expense Form Here
  						</div>
					</div>
					<!-- Currency Converter Form -->
					<div class="collapse" id="ccHome">
  						<div class="card card-body">
  							<p class="text-center font-weight-bold">Currency Converter</p>
  							<?php include('includes/cc_home.php');?>
  						</div>
					</div>
					<table class="table table-hover">
						<caption>Members Of Group</caption>
  						<thead class="thead-dark">
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Member</th>
						      <th scope="col">Contribution</th>
						    </tr>
  						</thead>
  						<tbody id='tableBody'>
  							<!--Table Body-->
  						</tbody>
  					</table>
				</main>
			</div>
		</div>
		<?php include('includes/groupFormModal.php'); ?>
		<?php include('includes/footer.php'); ?>
		<?php include('backend/showGroup.php'); ?>
	</body>
</html>