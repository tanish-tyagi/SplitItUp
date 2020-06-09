<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('includes/config.php');

$id = $_SESSION['id'];
$invited22 = $n;;

$query222 = "SELECT id,gname,membersCount,type FROM groups WHERE creator_id='$id' ";
$result222 = mysqli_query($con, $query222);
$rows222 = mysqli_num_rows($result222);
$arrExp222 = array();
if($rows222>=1){
	while($row222 = mysqli_fetch_assoc($result222)){
		array_push($arrExp222,$row222);
	}
}

?>

<div class="container-fluid">
	<form method="POST" action="backend/inviteFormBack.php">
		<div class="form-row">
			<div class="col">
				<label for="GroupSelect12" class="font-weight-bolder">Select One Of Your Group</label>
				<div class="input-group mb-3">
  					<div class="input-group-prepend">
    					<label class="input-group-text" for="GroupSelect12">Your Groups</label>
  					</div>
  					<select class="custom-select" id="GroupSelect12" name="inv_gid">
              <option value="0">Select Group</option>
    					<?php

    						foreach ($arrExp222 as $line) {
    							if($line['type']=='F')
    								$typee = 'Family';
    							else
    								$typee = 'Friends';
    							$txt = "<option value='".$line['id']."/".$invited22."'>";
    							$txt .= "  ".$line['gname']."  : MembersCount <span class='text-monospace'>".$line['membersCount']."</span>: Type- <span class='text-monospace'>".$typee."</span> ";
    							$txt .= "</option>";

    							echo($txt);
    						}

    					?>
  					</select>
				</div>
			</div>
			<div class="col">
				<div class="input-group mb-3" style="margin: 1.8rem;">
					<button class="btn btn-warning btn-lg" type="submit" name="inviteSubmit"><i class="fas fa-plus-circle"></i> Invite</button>
				</div>
			</div>
		</div>
    <div><span class="badge badge-info">Invitation Mail Will Be Sent On Your Behalf.</span></div>
	</form>
</div>

