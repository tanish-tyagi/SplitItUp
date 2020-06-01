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

$messages_query = "SELECT * FROM group_chats WHERE group_id='$g'";
$mresult = mysqli_query($con, $messages_query);
$msg_array = array();
$rows_num = mysqli_num_rows($mresult);
if($rows_num>=1){
 	while($row = mysqli_fetch_assoc($mresult)){
 		array_push($msg_array, $row);
 	}
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
						<h1 class="display-4"><?php echo($gname); ?></h1>
						<div class="btn-group btn-group-lg mr-2">
							<button type="button" class="btn btn-sm btn-outline-secondary"
							data-toggle="collapse" data-target="#addExpense" aria-expanded="false" aria-controls="addExpense"><i class="fas fa-plus-circle"></i> Add Expense</button>
            				<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="collapse" data-target="#groupChat" aria-expanded="false" aria-controls="groupChat"><i class="far fa-comment-alt"></i> Send Group Message</button>
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
					<div class="row">
						<div class="col"></div>
						<div class="col-9">
							<table class="table table-hover text-center">
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
  						</div>
						<div class="col"></div>
					</div>
					<div class="card-deck">
						<div class="card border-primary bg-light mb-3">
							<div class="card-header"><h4 class="text-primary font-weight-bold">Creator</h4></div>
    						<div class="card-body text-primary text-center">
      							<p class="card-text"><h2 id='grpCreator'></h2></p>
    						</div>
  						</div>
  						<div class="card text-white border-danger bg-success mb-3">
  							<div class="card-header"><h4 class="font-weight-bold">Total</h4></div>
    						<div class="card-body text-center">
      							<p class="card-text"><h3 id='toTal'></h3></p>
    						</div>
  						</div>
  						<div class="card text-white border-success bg-warning mb-3">
  							<div class="card-header"><h4 class="font-weight-bold">Share Per Member</h4></div>
    						<div class="card-body text-center">
      							<p class="card-text"><h3 id='shaRe'></h3></p>
    						</div>
  						</div>
  						<div class="card text-white bg-dark border-warning mb-3">
  							<div class="card-header"><h4 class="font-weight-bold">Members Count</h4></div>
    						<div class="card-body text-center">
      							<p class="card-text"><h1 id='count'></h1></p>
    						</div>
  						</div>
					</div>
					<hr style="background-color: #002266;">
					<br><br>
					<div class="collapse" id="groupChat">
  						<div class="card text-white bg-secondary card-body">
  							<p class="font-weight-bold"><h4>Send Message</h4></p>
  							<?php include('includes/groupChatForm.php');?>
  						</div>
					</div>
					<div class="row">
						<div class="col" id='down'></div>
						<div class="col-9 table-wrapper-scroll-y my-scrollbar">
							<table class="table table-bordered table-hover text-center">
								<caption>Group Chat</caption>
								<thead>
								    <tr>
								      <th scope="col">At:</th>
								      <th scope="col">Message:</th>
								    </tr>
  								</thead>
  								<tbody>
  									<?php 
  									    $i = 0;
  									 	foreach ($msg_array as $msg_row) {
  									 		$i++;
  									 		$mem_name = $msg_row['member_name'];
  									 		$dt = $msg_row['dttime'];
  									 		$dte = explode(' ', $dt);
  									 		$dte1 = $dte[0];
  									 		$dte2 = explode('-', $dte1);
  									 		$date = $dte2[2]."/".$dte2[1]."/".$dte2[0];
  									 		$time = end($dte);
  									 		$msg = "'<strong>".$mem_name."</strong>' => ".$msg_row['message'];

  									 		$tble = "<tr>
													    <th scope='row'>".$time.", ".$date."</th>
													    <td>".$msg."</td>
													 </tr>";
											echo($tble);
  									 	}
  									?>
  								</tbody>
							</table>
						</div>
						<div class="col"></div>
					</div>
				</main>
			</div>
		</div>
		<?php include('includes/groupFormModal.php'); ?>
		<?php include('includes/footer.php'); ?>
		<?php include('backend/showGroup.php'); ?>
	</body>
</html>
