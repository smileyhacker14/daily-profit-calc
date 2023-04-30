<div class="container">
	<?php
	$type = $_POST['filter_type'];
	$type_name = $_GET['dailyincomelist'];
	$webname = basename($_SERVER['PHP_SELF']);
	global $result;
	switch ($type) {
	    case 'week':
	        $result = Daily::filterWeek($_SESSION['user_id']);
	        break;

	    case 'month':
	        $result = Daily::filterMonth($_SESSION['user_id']);
	        break;

	    case 'year':

	        break;

	    case 'date':
	        $start_date = $_POST['start_date'];
	        $end_date = $_POST['end_date'];
	        $result= Daily::filterWithDates($_SESSION['user_id'], $start_date, $end_date);
	        break;
	}
	?>

<div id="active-filter" class="d-flex flex-row mx-2 justify-content-end">
			<img src="libs/img/11.png" alt="filter" height="50px">
		</div>
	<div id="toggle_filter">

		<form method="POST" action="<?=$webname?>?dailyincomelist=<?=$type_name?>">

			<div id="show-filter" class="row d-none flex-row mx-2 justify-content-center mt-4 fw-bold ">

				<div class="px-2">
					<label><input type="radio" name="filter_type" value="week">
						Week</label>
				</div>
				<div class="px-2">

					<label><input type="radio" name="filter_type" value="month">
						Month</label>
				</div>
				<div class="px-2">

					<label><input type="radio" name="filter_type" value="year">
						Year</label>
				</div>
				<div class="px-2">

					<label><input type="radio" id="custom" name="filter_type" value="date"> Custom</label>
				</div>

			</div>


			<div id="custom-filter" class="row d-none flex-row mx-2 justify-content-center">
				<div class="px-4">
					<label>From</label>
					<input type="date" name="start_date" class="form-control">
				</div>

				<div class="px-4">
					<label for="">To</label>
					<input type="date" name="end_date" class="form-control">
				</div>
			</div>

</form>

			<div id="filter-options" class="d-none flex-row mx-2 mt-4 justify-content-end">
				<button id="apply-filter" class="mx-3 border-1 rounded p-1 bg-primary" type="submit">Filter</button>
				
				<button id="cancel-filter" class="rounded border-1 p-1  bg-danger">Cancel</button>
			</div>

	</div>





</div>
</div>
</div>
</div>
<!-- 
<h1 id="result"></h1> -->
<!-- <script>
	const btn = document.querySelector('#apply-filter');
	const radioButtons = document.querySelectorAll('input[name="filter_type"]');
	btn.addEventListener("click", () => {
		let selectedSize;
		for (const radioButton of radioButtons) {
			if (radioButton.checked) {
				selectedSize = radioButton.value;
				break;
			}
		}
		// show the output:
		result.innerText = selectedSize ? `You selected ${selectedSize}` : `You haven't selected any size`;
	});
</script> -->