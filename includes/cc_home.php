<div class="container-fluid">
	<form class="form-inline">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" style="background-color: #002266; color: white;" id="value">Enter Value :</span>
        </div>
        <input type="number" value="1" min="1" max="10000000000" class="form-control" id="cc_value" placeholder="Value" aria-label="VALUE" aria-describedby="value" required autofocus>
    </div>
    <div class="mb-3"><span style="margin: 20px;"></span></div>
		<div class="input-group mb-3">
    		<div class="input-group-prepend">
    			<label class="input-group-text" for="fromGroup">From :</label>
  			</div>
		  		<select class="custom-select" id="fromGroup" required>
				    <option value="INR">INR Indian Rupee</option>
                    <option value="USD" selected>USD US Dollar</option>
                    <option value="EUR">EUR Euro</option>
                    <option value="GBP">GBP British Pound</option>
                    <option value="AUD">AUD Australian Dollar</option>
                    <option value="SGD">SGD Singapore Dollar</option>
                    <option value="JPY">JPY Japanese Yen</option>
                    <option value="BRL">BRL Brazilian Real</option>
                    <option value="CNY">CNY Chinese Yuan</option>
                    <option value="AED">AED UAE Dirham</option>
                    <option value="RUB">RUB Russian Rubel</option>
				</select>
		</div>
		<div class="mb-3">
			<h3><span class="badge badge-light"><i class="fas fa-exchange-alt"></i></span></h3>
		</div>
		<div class="input-group mb-3">
    		<div class="input-group-prepend">
    			<label class="input-group-text" for="toGroup">To :</label>
  			</div>
		  		<select class="custom-select" id="toGroup" required>
				    <option value="INR" selected>INR Indian Rupee</option>
                    <option value="USD">USD US Dollar</option>
                    <option value="EUR">EUR Euro</option>
                    <option value="GBP">GBP British Pound</option>
                    <option value="AUD">AUD Australian Dollar</option>
                    <option value="SGD">SGD Singapore Dollar</option>
                    <option value="JPY">JPY Japanese Yen</option>
                    <option value="BRL">BRL Brazilian Real</option>
                    <option value="CNY">CNY Chinese Yuan</option>
                    <option value="AED">AED UAE Dirham</option>
                    <option value="RUB">RUB Russian Rubel</option>
				</select>
		</div>
	</form>
	<div class="mb-3">
		<button class="btn btn-success btn-lg" id="cc_submit" onclick="convert()" data-toggle="modal" data-target="#staticBackdrop"><i class="far fa-money-bill-alt"></i> Convert</button>
	</div>
	
</div>
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Currency Converter</h5>
        <button type="button" class="close" onclick="change()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="output">Output</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="modalClose" data-dismiss="modal" onclick="change()"><i class="far fa-times-circle"></i> Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Ends -->

<script type="text/javascript">
	const from_currency = document.getElementById('fromGroup');
	const amount = document.getElementById('cc_value');
	const to_currency = document.getElementById('toGroup');
  const btn = document.getElementById('ccBtn');
	var op = 0;
	const output = document.getElementById('output');

  btn.addEventListener('click', function(){
    var x = btn.getAttribute("class");
    if(x === 'nav-link active'){
      btn.setAttribute("class", "nav-link");
    }
    else{
      btn.setAttribute("class", "nav-link active");
    }
  });

	function convert(){

		const from = from_currency.value;
		const to = to_currency.value;
		const amt = amount.value;

		if(amt>0){
			fetch(`https://api.exchangerate-api.com/v4/latest/${from}`).then(res => res.json()).then(res => {
				const rate = res.rates[to];
				op = (amt*rate).toFixed(2);
				output.innerHTML = amt+" "+from+" = "+op+" "+to;
			});
		}
	}

	function change() {
		output.innerHTML = "Output";
	}
	

</script>