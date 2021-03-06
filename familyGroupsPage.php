<?php

session_start();
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	die();
}

$fname = 'USER';

if(!empty($_SESSION['name'])){
	$fname = $_SESSION['name'];
    $farr = explode(' ', $fname);
    $fname = $farr[0];
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	    <title>SplitItUp :: Family</title>
	    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
	    <?php include('includes/head_files.html'); ?>
	</head>
	<body>
		<?php include('includes/header_l.php'); ?>
		<div class="container-fluid" style="margin-top: 4rem; ">
			<div class="row">
				<?php include('includes/sidebar_l.php');?>
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
					<?php include('includes/chartjsSizeMonitor.php'); ?>
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h2 class="display-4"><i class="fas fa-user-friends"></i> FAMILY GROUPS</h2>
						<div class="btn-group btn-group-lg mr-2">
							<button type="button" class="btn btn-sm btn-outline-secondary"
							data-toggle="collapse" data-target="#addExpense" aria-expanded="false" aria-controls="addExpense"><i class="fas fa-plus-circle"></i> Add Expense</button>
            				<button type="button" onclick="scrollDown()" class="btn btn-sm btn-outline-secondary"><i class="far fa-chart-bar"></i> Your Stats</button>
            				<button type="button" onclick="scrollFunction()" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-down"></i></button>
          				</div>
					</div>
					<!-- Add Expense Form -->
					<div class="collapse" id="addExpense">
  						<div class="card card-body">
  							<p class="text-center font-weight-bolder">Add Expense</p>
  							<?php include('includes/addExpenseForm.php');?>
  						</div>
					</div>
					<!-- Currency Converter Form -->
					<div class="collapse" id="ccHome">
  						<div class="card card-body">
  							<p class="text-center font-weight-bold">Currency Converter</p>
  							<?php include('includes/cc_home.php');?>
  						</div>
					</div>
					<div class="card-deck mb-3 text-center" id="cardDeckFamily">
						Loading....
					</div>
					<hr style="background-color: #002266">
					<?php include('includes/chart.php'); ?>
				</main>
				<div id='btm'></div>
			</div>
		</div>
		<script type="text/javascript">
			function scrollDown(){
				var btm = document.getElementById('btm');
				btm.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
			}
		</script>
		<?php include('includes/groupFormModal.php'); ?>
		<?php include('includes/footer.php'); ?>
		<?php include('backend/familyGroups.php'); ?>
	</body>
</html>