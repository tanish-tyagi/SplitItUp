<?php

session_start();
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	die();
}

$fname = 'USER';
$id = $_SESSION['id'];

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
	    <title>SplitItUp :: Homepage</title>
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
						<h1 class="display-4">ACTION CENTER</h1>
						<div class="btn-group btn-group-lg mr-2">
							<button type="button" class="btn btn-sm btn-outline-secondary"
							data-toggle="collapse" data-target="#addExpense" aria-expanded="false" aria-controls="addExpense"><i class="fas fa-plus-circle"></i> Add Expense</button>
            				<button type="button" class="btn btn-sm btn-outline-secondary"><i class="far fa-chart-bar"></i> Your Stats</button>
          				</div>
					</div>
					<!-- Add Expense Form -->
					<div class="collapse" id="addExpense">
  						<div class="card card-body">
  							<p class="text-center font-weight-bold">Currency Converter</p>
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
					<div class="card-deck mb-3 text-center">
						<div class="card mb-4 shadow-sm">
							<div class="card-header"><h4 class="my-0 font-weight-bolder">Friends</h4></div>
							<img class="card-image-top" onclick="window.location.href = 'friendsGroupPage.php'" src="index/images/content img-3.png" style="padding: 2.5rem; cursor: pointer;">
							<div class="card-body"></div>
						</div>
						<div class="card mb-4 shadow-sm">
							<div class="card-header"><h4 class="my-0 font-weight-bolder">Family</h4></div>
							<img class="card-image-top" onclick="window.location.href = 'familyGroupsPage.php'" src="index/images/content img-2.png" style="padding-top: 2.5rem; padding-left: 1rem; padding-right: 1rem; padding-bottom: 2.5rem; cursor: pointer;">
							<div class="card-body"></div>
						</div>
						<div class="card mb-4 shadow-sm">
							<div class="card-header"><h4 class="my-0 font-weight-bolder">Your Profile</h4></div>
							<img class="card-image-top" onclick="window.location.href = 'userDetails.php?u=<?php echo($id); ?>'" src="index/images/content img-1.png" style="padding: 2.5rem; cursor: pointer;">
							<div class="card-body"></div>
						</div>
					</div>
				</main>
			</div>
		</div>
		<?php include('includes/groupFormModal.php'); ?>
		<?php include('includes/footer.php'); ?>
	</body>
</html>