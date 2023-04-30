<?php
include 'libs/load.php';
if(empty($_SESSION['user_id'])) {
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
	<title><?=ucfirst($_GET['dailyincomelist'])?>
	</title>
	<link rel="stylesheet" href="@sweetalert2/theme-borderless/borderless.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
		integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<style>
		.popup {
			display: flex;
		}
	</style>
</head>

<body>

	<?php load_template('__header'); ?>

	<?load_template('__filter')?>
	<div class="container rounded py-3" style="background-color:#F8F8F8;">

		<table class="table table-dark table-hover align-middle text-white text-center"
			style="border-bottom-left-radius:10px;border-bottom-right-radius:10px;backdrop-filter:blur(10px);">
			<thead>
				<tr>
					<th>Description</th>
					<th>Amount</th>
					<th>Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<?php

            $action = $_GET['dailyincomelist'];
switch($action) {
    case "income":
        $result = Daily::getIncomeList($_SESSION['user_id']);
        break;
    case "expense":
        $result = Daily::getExpenseList($_SESSION['user_id']);
        break;
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
			<tr class="table-row">
				<td hidden class="value">
					<?=$row['id']?>
				</td>
				<td><?=$row['description']?></td>
				<td><?=number_format($row['amount'])?>
				</td>
				<td><?=$row['date']?></td>
				<td><button class="btn-primary" class="edit"><a style="text-decoration: none;"
							href="edit.php?id=<?=$row['id']?>&type=<?=$row['type']?>&description=<?=$row['description']?>&amount=<?=$row['amount']?>&date=<?=$row['date']?>"
							class="edit text-white text-decoration-none">Edit</a></button>
					<button class="delete text-decoration-none btn-primary">Delete</button>
				</td>


			</tr>
			<?}
    } else {
        ?>
			<h1>No Entry Yet</h1><?php
    }
?>
		</table>
	</div>
	<?php load_template('__footer')?>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="js/table.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>



</html>