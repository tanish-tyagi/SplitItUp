<?php

session_start();
if(!isset($_SESSION['id'])){
	header('Location: index.php');
	die();
}

include('includes/config.php');

$fname = 'USER';
$id = $_SESSION['id'];

if(!empty($_SESSION['name'])){
	$fname = $_SESSION['name'];
    $farr = explode(' ', $fname);
    $fname = $farr[0];
}

if(isset($_GET['search'])){

	$search = mysqli_real_escape_string($con, $_GET['searchterm']);
	$arr = array();
	$flag = 1;
	$thead = "";

	if(empty($search)||is_numeric($search)){
		echo "<script>alert('Invalid Input');window.open('index.php','_self');</script>";
	}
	else{

		$query = "SELECT id,name,email FROM users WHERE name LIKE '%$search%' ";
		$result = mysqli_query($con,$query);
		$rows = mysqli_num_rows($result);
		if($rows>=1){

			while($row = mysqli_fetch_assoc($result)){
				array_push($arr,$row);
			}

			$thead .= "<thead class='thead-dark'>
						<tr>
							<th scope='col'>Name</th>
							<th scope='col'>E-Mail</th>
						</tr>
						</thead>";

		}
		else{

			$grp_query = "SELECT id, gname, creator FROM groups WHERE gname LIKE '%$search%' ";
			$grp_result = mysqli_query($con,$grp_query);
			$rows = mysqli_num_rows($grp_result);
			if($rows>=1){

				while($row = mysqli_fetch_assoc($grp_result)){
					array_push($arr, $row);
				}

				$flag = 0;

				$thead .= "<thead class='thead-dark'>
							<tr>
								<th scope='col'>Group Name</th>
								<th scope='col'>Created By</th>
							</tr>
							</thead>";
			}
			else{
				echo "<script>alert('No Results Found');window.open('index.php','_self');</script>";
			}
		}
	}

}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	    <title>SplitItUp :: Results</title>
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
						<h2 class="display-4">Search Results</h2>
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
					<div class="row">
						<div class="col"></div>
						<div class="col-8">
							<div class="card-header"><?php echo($rows); ?> Results Found!! For '<?php echo($search);?>'</div>
							<table class="table text-center table-hover">
								<?php echo($thead); 
								      echo "<tbody>";
									foreach ($arr as $line) {
										$one = ""; $two = ""; $link_id="";
										$l = "<tr>";
										if($flag===1){
											$one = $line['name'];
											$two = $line['email'];
											$link_id = "userDetails.php?u=".$line['id'];
										}
										else{
											$one = $line['gname'];
											$two = $line['creator'];
											$link_id = "groupDetails.php?q=".$line['id'];
										}
										$l .= "<td onclick='window.location.href = `".$link_id."`' style='cursor: pointer;'><strong>-> ".$one."</strong></td><td>".$two."</td></tr>";
										echo $l;
									}
									  echo "</tbody>";
								?>
							</table>
						</div>
						<div class="col"></div>
					</div>
				</main>
			</div>
		</div>
		<?php include('includes/groupFormModal.php'); ?>
		<?php include('includes/footer.php'); ?>
	</body>
</html>