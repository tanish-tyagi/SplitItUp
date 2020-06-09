<canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" style="position: relative;">
</canvas>

<script type="text/javascript">

	function scrollFunction(){
		var chrt = document.getElementById('myChart');
		chrt.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
	}

	var chartel = document.getElementById('myChart');
	var userId = ('<?php echo $_SESSION['id']; ?>').valueOf();
	const groups = [];
	const expenses = [];

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
			var j=0;
			for(i=0; i<listedItems.length; i++){
				if(listedItems[i].is_active === '1'){
					groups[j] = listedItems[i].gname;
					expenses[j] = listedItems[i].expense;
					j++;
				}
			}
			showchart(chartel);
		}
		xhr.send();
	}

	findGroups(chartel);

  function showchart(element) {
  'use strict'

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: groups,
      datasets: [{
        data: expenses,
        pointStyle: 'star',
        pointRadius: 5,
        pointHitRadius: 10,
        pointRotation: 180,
        lineTension: 0.05,
        borderColor: '#002266',
        //backgroundColor: '#002266',
        borderWidth: 4,
        hoverBorderWidth: 1,
        hoverBorderColor: '#000000',
        pointBackgroundColor: '#002266',
        fill: false,
        label: 'Expenditure',
        spanGaps: false,
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          },
          scaleLabel: {
          	display: true,
          	labelString: '₹ Rupees:',
          },
      }],
      	xAxes: [{
      		ticks: {
            	beginAtZero: false
          	},
      		scaleLabel: {
          		display: true,
          		labelString: 'Groups:',
          	},
      	}],
      },
      legend: {
        display: true,
        position: 'bottom',
      },
      title: {
            display: true,
            text: 'Statistics',
            position: 'bottom',
        },
    }
  });
}
</script>

