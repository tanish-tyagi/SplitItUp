<?php

?>

<script type="text/javascript">
	const cardDeck = document.getElementById('cardDeckFamily');
	cardDeck.innerHTML = "";
	var userId = ('<?php echo $_SESSION['id']; ?>').valueOf();

	function populateCardDeck(grp_id, share){

		const xhr1 = new XMLHttpRequest();
		const method1 = "GET";
		const url1 = "http://localhost/Ganesh%20Ji/backend/detailGroup.php?q="+grp_id;
		const responseType1 = "json";
		const your_share = share;

		var card = "";
		xhr1.responseType = responseType1;
		xhr1.open(method1, url1);
		xhr1.onload = function(){
			const serverResponse = xhr1.response;
			const list = serverResponse;

			var gid = String(list.id.valueOf());
			var gname = String(list.gname);
			var creator = String(list.creator);
			var type = String(list.type);
			var admins = String(list.admins);
			var count = String(list.membersCount);
			var assets = String(list.assets);
			var date = String(list.date_created);

			var adminarr = admins.split(",");
			var dt = date.split(" ");
			date = dt[0];

			var each_share = (list.assets.valueOf())/(list.membersCount.valueOf());
			var minus_share = your_share.valueOf()-each_share.valueOf();
			var owe = "";
			if(your_share.valueOf() >= each_share.valueOf()){
				owe = "This Group owes you";
			}else{
				owe = "You owe this Group";
				minus_share *= -1;
			}

			if(list.creator_id.valueOf() === userId){
				creator = "You";
			}

			var typeText = "";
			var theme = "";
			if(type === 'F'){
				typeText = "Family";
				theme = "success";
			}else{
				typeText = "Friends";
				theme = "primary";
			}

			if(type === 'F'){
				
				card = `<div class="card border-`+theme+`" id='c-`+gid+`' style="max-width: 19rem; min-width: 16rem; margin-top: 0.5rem; margin-bottom: 0.5rem;">
						<div class="card-header"><h3>`+gname+`</h3></div>
    					<div class="card-body text-`+theme+`" style="cursor:pointer;" onclick="window.location.href = 'groupDetails.php?q=`+gid+`'">
      					<h5 class="card-title">`+typeText+`</h5>
      					<h6 class="card-subtitle mb-2 text-muted"><small>Owner-</small>`+creator+`</h6>
     				 	<p class="card-text">Total - <i class="fas fa-rupee-sign"></i> `+assets+`</p>
      					<p class="card-text"><small class="text-muted">Members - `+count+`</small></p>
      					<p class="card-text"><small class="text-muted">Your Contribution - <i class="fas fa-rupee-sign"></i> `+your_share+`</small></p>
      					<p class="card-text"><small class="text-muted">Share Per Member - <i class="fas fa-rupee-sign"></i> `+each_share+`</small></p>
      					<p class="card-text text-monospace font-weight-bold">`+owe+` - <i class="fas fa-rupee-sign"></i> `+minus_share+`</p>
    					</div>
    					<div class="card-footer text-muted"> Created:`+date+`</div>
 			 		</div>`;

 				cardDeck.innerHTML += card;
			}
		}
		xhr1.send();
	}

	function findGroups(element){

		const xhr = new XMLHttpRequest();
		const method = "GET";
		const url = "http://localhost/Ganesh%20Ji/backend/displayGroups.php?q="+userId;
		const responseType = "json"

		xhr.responseType = responseType;
		xhr.open(method,url);
		xhr.onload = function(){

			const serverResponse = xhr.response;
			const listedItems = serverResponse;
			var i;
			for(i=0; i<listedItems.length; i++){
				if(listedItems[i].is_active === '1'){
					populateCardDeck(listedItems[i].group_id.valueOf(),listedItems[i].expense.valueOf());
				}
			}
		}
		xhr.send();
	}

	findGroups(cardDeck);


</script> 