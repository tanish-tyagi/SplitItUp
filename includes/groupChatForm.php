<div class="container-fluid">
	<form class="form" id="chatForm" action="backend/groupChatAdd.php" method="POST">
		<div class="input-group mb-3">
  			<div class="input-group-prepend">
    			<span class="input-group-text text-wrap">Message</span>
  			</div>
  			<textarea class="form-control" aria-label="Message" name="msg" for="chatForm" autocomplete="off" required></textarea>
		</div>
		<input type="hidden" value='<?php echo($g); ?>' name="grpID">
		<input type="hidden" value='<?php echo($gname); ?>' name="grpName">
		<div class="input-group mb-3"><button class="btn btn-danger btn-lg" type="submit" name="chatSubmit"><i class="fas fa-reply"></i> SEND</button></div>
	</form>
</div>