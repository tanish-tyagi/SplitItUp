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

$n = $_GET['u'];
if(!is_numeric($n)){
	header("Location: index.php");
}

$msg = "";
$table = "";

if($n === $_SESSION['id']){

	$query = "SELECT name, email, profile_pic, gender, date_created, last_accessed FROM users WHERE id='$n' ";
	$select_result = mysqli_query($con, $query);
	$arr = mysqli_fetch_assoc($select_result);

	$query2 = "SELECT gname, expense FROM expensetable WHERE member_id='$id' AND is_active='1' ";
	$result2 = mysqli_query($con, $query2);
	$rows = mysqli_num_rows($result2);
	$arr2 = array();
	$i=0;
	$table = "<thead>
    			<tr>
      				<th scope='col'>#</th>
      				<th scope='col'>Group</th>
      				<th scope='col'>Expenditure</th>
    			</tr>
  			</thead><tbody>";
	$total = 0;
	if($rows>=1){
		while($row = mysqli_fetch_assoc($result2)){
			array_push($arr2,$row);
			$total += (int)$arr2[$i]['expense'];
			$table .= "<tr>
			            <th scope='col'>".($i+1)."</th>
      					<td>".$arr2[$i]['gname']."</td>
      					<td>₹".$arr2[$i]['expense']."</td>
    					</tr>";
			$i++;
		}
	}

	$flag = 1;
	$table .="</tbody>";
	$msg = "<li class='list-group-item'><h4 style='font-family: Almarai;'><strong style='font-style: italic;'>Last LogIn: </strong>".$arr['last_accessed']."</h4></li>";
	$msg .= "<li class='list-group-item'><h4 style='font-family: Almarai;'><strong style='font-style: italic;'>Total Expenditure: </strong>₹".$total."</h4></li>";
	$msg .= "<li class='list-group-item'><h4 style='font-family: Almarai;'><strong style='font-style: italic;'>Account Opened: </strong>".$arr['date_created']."</h4></li>";
}
else{

	$else_query = "SELECT name, email, profile_pic, gender FROM users WHERE id='$n' ";
	$else_result1 = mysqli_query($con, $else_query);
	$arr = mysqli_fetch_assoc($else_result1);

	$else_query2 = "SELECT gname FROM expensetable WHERE member_id='$n' AND is_active='1' ";
	$else_result2 = mysqli_query($con, $else_query2);
	$rows = mysqli_num_rows($else_result2);
	$arr2 = array();
	$table = "<thead>
    			<tr>
      				<th scope='col'>#</th>
      				<th scope='col'>Group</th>
    			</tr>
  			</thead><tbody>";
  	$i=0;
	if($rows>=1){
		while($row = mysqli_fetch_assoc($else_result2)){
			array_push($arr2,$row);
			$table .= "<tr>
			            <th scope='col'>".($i+1)."</th>
      					<td>".$arr2[$i]['gname']."</td>
    					</tr>";
    		$i++;
		}
	}

	$table .= "</tbody>";
	$flag = 0;

}


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta http-equiv="X-UA-Compatible" content="IE-edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	    <title>SplitItUp</title>
	    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
	    <link href='https://fonts.googleapis.com/css?family=Almarai' rel='stylesheet'>
	    <link rel="stylesheet" type="text/css" href="css/messagesTable.css">
	    <?php include('includes/head_files.html'); ?>
	</head>
	<body>
		<?php include('includes/header_l.php'); ?>
		<div class="container-fluid" style="margin-top: 4rem; ">
			<div class="row">
				<?php include('includes/sidebar_l.php');?>
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
						<h1 class="display-4">PROFILE</h1>
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
					<?php echo('<br>');  ?>
					<div class="row">
						<div class="col"></div>
						<div class="col-5">
							<div class="card-header bg-success text-light text-center"><h3>Details Of User</h3></div>
							<div class="card border-primary align-items-center">
								<br>
								<img src="uploads/<?php echo($arr['profile_pic']); ?>" class="card-img-top" alt="..." style="display: inline-block; width: 150px; height: 150px; border-radius: 50%; background-repeat: no-repeat; background-position: center center;background-size: cover;">
								<div class="card-body text-center" style="width: 100%">
									<ul class="list-group list-group-flush">
										<li class="list-group-item"><h4 style="font-family: Almarai;"><strong style="font-style: italic;">Name: </strong><?php echo($arr['name']); ?></h4>
										</li>
										<li class="list-group-item"><h4 style="font-family: Almarai;"><strong style="font-style: italic;">E-Mail: </strong><?php echo($arr['email']); ?></h4>
										</li>
										<?php if($flag===1){
											echo($msg);
										}
										?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-5 table-wrapper-scroll-y my-scrollbar" style="max-height: 40rem; ">
							<div class="card-header bg-warning text-light text-center"><h3>Groups Of User</h3></div>
							<div class="card border-primary align-items-center">
								<div class="card-body text-center" style="width: 100%">
									<table class="table">
										<?php echo($table); ?>
									</table>
								</div>
							</div>
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