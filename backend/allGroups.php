<?php

?>

<script type="text/javascript">
	const cardDeck = document.getElementById('cardDeck');
	cardDeck.innerHTML = "";
	var userId = ('<?php echo $_SESSION['id']; ?>').valueOf();

	function populateCardDeck(grp_id){

		const xhr1 = new XMLHttpRequest();
		const method1 = "GET";
		const url1 = "http://localhost/Ganesh%20Ji/backend/detailGroup.php?q="+grp_id;
		const responseType1 = "json";

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

			card = `<div class="card border-`+theme+`" id='c-`+gid+`' style="max-width: 17rem; min-width: 17rem; margin-top: 0.5rem; margin-bottom: 0.5rem;">
						<div class="card-header"><h3>`+gname+`</h3></div>
    					<div class="card-body text-`+theme+`">
      					<h5 class="card-title">`+typeText+`</h5>
      					<h6 class="card-subtitle mb-2 text-muted">By-`+creator+`</h6>
     				 	<p class="card-text">Total Assets - <i class="fas fa-rupee-sign"></i> `+assets+`</p>
      					<p class="card-text"><small class="text-muted">Members - `+count+`</small></p>
    					</div>
    					<div class="card-footer text-muted"> Created:`+date+`</div>
 			 		</div>`;

 			cardDeck.innerHTML += card;
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
				populateCardDeck(listedItems[i].group_id.valueOf());
			}
		}
		xhr.send();
	}

	findGroups(cardDeck);


</script> 