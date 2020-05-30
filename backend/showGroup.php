<?php

?>

<script type="text/javascript">

	const tableBody = document.getElementById('tableBody');
	tableBody.innerHTML = "";
	const grpId = ('<?php echo $g; ?>').valueOf();
	
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
			var i;
			for(i=0; i<listedItems.length; i++){
				var temp = "<tr><th scope='row'>"+(i+1).valueOf()+"</th><td>"+listedItems[i].member_name+"</td><td>"+listedItems[i].expense+"</td></tr>";
				final += temp;
			}
			tableBody.innerHTML = final;
		}
		xhr.send();
	}
	members(tableBody);

</script>
    