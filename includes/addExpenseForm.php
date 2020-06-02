<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('includes/config.php');

$id = $_SESSION['id'];
$is_active = 1;

$query = "SELECT group_id,gname,expense FROM expensetable WHERE member_id='$id' AND is_active='$is_active' ";
$result = mysqli_query($con, $query);
$rows = mysqli_num_rows($result);
$arrExp = array();
if($rows>=1){
	while($row = mysqli_fetch_assoc($result)){
		array_push($arrExp,$row);
	}
}

?>

<div class="container-fluid">
	<form method="POST" action="backend/addExpenseBack.php">
		<div class="form-row">
			<div class="col">
				<label for="amt" class="font-weight-bolder">Enter Amount</label>
				<div class="input-group mb-3">
  					<div class="input-group-prepend">
    					<span class="input-group-text" id="basic-addon"><i class="fas fa-rupee-sign"></i></span>
  					</div>
  					<input type="number" name="amtt" value="1" min="1" max="10000000" class="form-control" id="amt" aria-label="VALUE"aria-describedby="basic-addon" required autofocus>
				</div>
			</div>
			<div class="col">
				<label for="GroupSelect1" class="font-weight-bolder">Select A Group</label>
				<div class="input-group mb-3">
  					<div class="input-group-prepend">
    					<label class="input-group-text" for="GroupSelect1">Groups</label>
  					</div>
  					<select class="custom-select" id="GroupSelect1" name="grpID">
    					<?php

    						foreach ($arrExp as $line) {
    							$txt = "<option value='".$line['group_id']."/".$line['gname']."'>";
    							$txt .= "  ".$line['gname']."  : Previous Total ₹ <span class='text-monospace'>".$line['expense']."</span> ";
    							$txt .= "</option>";

    							echo($txt);
    						}

    					?>
  					</select>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="input-group mb-3">
				<button class="btn btn-success btn-lg" type="submit" name="amtSubmit"><i class="fas fa-plus-circle"></i> Add</button>
			</div>
		</div>
	</form>
</div>

