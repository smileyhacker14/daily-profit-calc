<?php include 'libs/load.php';


if((Session::authorization($_COOKIE['token']) == $_SESSION['user_id'])) {
    ?>
<script type="text/javascript">
	window.location.href = "login.php";
</script>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daily</title>
	<link rel="stylesheet" href="@sweetalert2/theme-borderless/borderless.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
		integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<style>
		/* Styles required only for the example above */
		.scrollspy-example {
			position: relative;
			height: 500px;
			overflow: auto;
		}
	</style>
</head>


<?php load_template('__header') ?>


<body>

	<div class="container rounded" style="background-color:#F8F8F8;">
		<h2 id="check"></h2>
		<div class="row">

			<div class="col-sm-4 justify-content-center text-center">
				<canvas id="myChart"></canvas>

				<div class="row justify-content-center">
					<?php
        $income = (int) Daily::getTotal('income', $_SESSION['user_id']);
$expense = (int) Daily::getTotal('expense', $_SESSION['user_id']);

if ($income > $expense) {
    ?>
					<h1>You Got Profit</h1> <br>
					<h1>Rs. <?=number_format(($income-$expense))?>
					</h1>
					<?php
} elseif ($income<$expense) {
    ?>
					<h1>Sorry You Are Loss</h1> <br>
					<h1>Rs.
						<?=number_format(abs(($income-$expense)))?>
					</h1>
					<?php
} elseif($income==0 and $expense==0) {
    ?>
					<h1>You Don't Have Any Entry Yet</h1><?php
} else {
    ?>
					<h1>The Amount Are Same...</h1><?php
}

?>
				</div>
			</div>


			<div class="col-md-8 text-center">
				<div class="row">
					<div class="col-md-6 text-center py-3">
						<a href="table.php?dailyinccomelist=income" class="text-dark text-decoration-none">
							<!--Printing Total of Income on Webpage-->
							<h3 class="text-dark fw-bold">Total of Income is<br><span id="income-total">
									Rs.
									<?=number_format(Daily::getTotal('income', $_SESSION['user_id']))?></span>
							</h3>
						</a>
						<div data-mdb-spy="scroll" data-mdb-target="#scrollspy1" data-mdb-offset="0"
							class="scrollspy-example">
							<!--Printing Values as table-->
							<table class="table table-dark align-middle text-white text-center rounded">
								<thead>
									<tr>
										<th>Description</th>
										<th>Date</th>
										<th>Amount</th>
										</trr>
								</thead>
								<?$result = Daily::getIncomeList($_SESSION['user_id']);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
								<tr class="table-row">
									<td hidden class="value">
										<?=$row['id']?>
									</td>
									<td><?=$row['description']?>
									</td>
									<td><?=$row['date']?>
									</td>
									<td>Rs.
										<?=number_format($row['amount'])?>
									</td>
								</tr>
								<?}
    }?>
							</table>


						</div>
					</div>

					<div class="col-md-6 py-3">
						<a href="table.php?dailyinccomelist=expense" class="text-decoration-none icon-link-hover">
							<!--Printing Total of Expense on Webpage-->
							<h3 class="text-dark fw-bold">Total of Expense is<br> <span id="expense-total">
									Rs.
									<?=number_format(Daily::getTotal('expense', $_SESSION['user_id']))?></span>
							</h3>
						</a>
						<div data-mdb-spy="scroll" data-mdb-target="#scrollspy1" data-mdb-offset="0"
							class="scrollspy-example">
							<!--Printing values as table-->
							<table class="table table-dark align-middle text-white text-center">
								<thead>
									<tr>
										<th>Description</th>
										<th>Date</th>
										<th>Amount</th>
										</trr>
								</thead>
								<?$result = Daily::getExpenseList($_SESSION['user_id']);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
								<tr class="table-row">
									<td hidden class="value">
										<?=$row['id']?>
									</td>
									<td><?=$row['description']?>
									</td>
									<td><?=$row['date']?>
									</td>
									<td>Rs.
										<?=number_format($row['amount'])?>
									</td>
								</tr>
								<?}
    }?>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

	<div class='footer'>
		<?php load_template('__footer') ?>
	</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>

<!--The following code will generate Pie chart for the calcualtion....-->
<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ['Income', 'Expense'],

			datasets: [{
				label: 'Amount is ',
				data: [ <?=$income?> , <?=$expense?> ],

				backgroundColor: [
					'rgba(0, 0, 255, 0.7)',
					'rgba(255, 0, 0, 0.7)',
					'rgba(255, 206, 86, 1)'
				],
				borderColor: [
					'rgba(255,255,255, 1)',
					'rgba(255,255,255, 1)',
					'rgba(255,255,255, 1)'
				],
				borderWidth: 0
			}]
		},
		options: {
			responsive: false,
			plugins: {
				legend: {
					position: 'bottom',
				},
				title: {
					display: true,
					text: 'Summery',
					color: 'black'
				}
			}
		}
	});
</script>

</html>
