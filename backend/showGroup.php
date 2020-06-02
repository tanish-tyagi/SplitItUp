<?php

?>

<script type="text/javascript">

	const tableBody = document.getElementById('tableBody');
	const grpCreator = document.getElementById('grpCreator');
	const count = document.getElementById('count');
	const total = document.getElementById('toTal');
	const share = document.getElementById('shaRe');
	const chatForm = document.getElementById('groupChat');
	const sign = "<i class='fas fa-rupee-sign'></i> ";
	share.innerHTML = "";
	total.innerHTML = "";
	count.innerHTML = "";
	grpCreator.innerHTML = "";
	tableBody.innerHTML = "";
	const grpId = ('<?php echo $g; ?>').valueOf();
	const userId = ('<?php echo($id); ?>').valueOf();

	function scrollDown(){
		chatForm.scrollIntoView();
	}
	
	function members(element){

		const xhr = new XMLHttpRequest();
		const method = "GET";
		const url = "http://localhost/Ganesh%20Ji/backend/showGroupBack.php?q="+grpId;
		const responseType = "json";

		xhr.responseType = responseType;
		xhr.open(method,url);
		xhr.onload = function(){

			const serverResponse = xhr.response;
			const listedItems = serverResponse;
			var final = "";
			var cl = " class='table-info'"
			var i;
			for(i=0; i<listedItems.length; i++){
				var temp = "";
				if(listedItems[i].member_id.valueOf() === userId){
					temp = "<tr"+cl+"><th scope='row'>"+(i+1).valueOf()+"</th><td onclick='window.location.href = `userDetails.php?u="+listedItems[i].member_id+"`' style='cursor: pointer;'>"+listedItems[i].member_name+"</td><td><i class='fas fa-rupee-sign'></i> "+listedItems[i].expense+"</td></tr>";
				}else{
					temp = "<tr><th scope='row'>"+(i+1).valueOf()+"</th><td  onclick='window.location.href = `userDetails.php?u="+listedItems[i].member_id+"`' style='cursor: pointer;'>"+listedItems[i].member_name+"</td><td><i class='fas fa-rupee-sign'></i> "+listedItems[i].expense+"</td></tr>";
				}
				final += temp;
			}
			tableBody.innerHTML = final;
		}
		xhr.send();
	}
	members(tableBody);

	function group(element){

		const xhr1 = new XMLHttpRequest();
		const method1 = "GET";
		const url1 = "http://localhost/Ganesh%20Ji/backend/detailGroup.php?q="+grpId;
		const responseType1 = "json";

		xhr1.responseType = responseType1;
		xhr1.open(method1,url1);
		xhr1.onload = function(){
			const serverResponse = xhr1.response;
			const listedItems = serverResponse;
			grpCreator.innerHTML = String(listedItems.creator);
			count.innerHTML = String(listedItems.membersCount);
			total.innerHTML = sign+String(listedItems.assets);
			share.innerHTML = sign+String((listedItems.assets.valueOf()/listedItems.membersCount.valueOf()).toFixed(2));
		}
		xhr1.send();
	}
	group(grpCreator);

</script>
    