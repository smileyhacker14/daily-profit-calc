<?php

use JetBrains\PhpStorm\NoReturn;

session_start();

include 'include/actions.class.php';
include 'include/Database.class.php';
include 'include/Session.class.php';
include 'include/user.class.php';



//this funtion used to load templates//
function load_template($name)
{
    include $_SERVER['DOCUMENT_ROOT']."/daily-profit/__templates/$name.php";
}

// $action and $id will get the value where the Button clicked in update or delete button
$action = $_POST['action'];
$id = $_POST['id'];
if ($_GET['action'] == 'd') {

    try {
        Session::removeUserSesstion($_GET['token']);
    } catch(Exception) {
    }
    session_unset();
    session_destroy();
    ?>
	<script type="text/javascript"> 
		history.back();
		</script>
	<?php
}


if ($action == 'update') {
    $desc = $_POST['description'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];

} elseif($action == 'insert') {
    $desc = $_POST['description'];
    $date =$_POST['date'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];

}


switch ($action) {
    // if the value of $action is :update then the return statement will executed and return
    case "update":
        // The Daily::updateEntry will update the database entry withe following arguments...
        return Daily::updateEntry($id, $desc, $date, $amount);
        break;
    case "delete":
        return Daily::deleteEntry($id, $_SESSION['user_id']);
        break;
    case "insert":
        return Daily::insertValues($desc, $date, $amount, $type, $_SESSION['user_id']);
        break;
    case "incomeList":
        $data = array();
        $result = Daily::getExpenseList($_SESSION['user_id']);
        while ($row = $result->fetch_object()) {
            $data[] = $row;
        }
        return json_encode($data);

}


$get = $_POST['getValue'];

switch ($get) {
    case "income":
        return Daily::getTotal('income', $_SESSION['user_id']);
        break;

    case "expense":
        return Daily::getTotal('expense', $_SESSION['user_id']);
        break;
}
