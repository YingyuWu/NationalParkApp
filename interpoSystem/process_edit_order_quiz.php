<?php
error_reporting(-1);
ini_set('display_errors', 'off');
include('includes/header.html');
//Check for empty fields
//Create short variables
$question = $_POST['question'];
$questionid = $_POST['questionid'];
$modified = $_POST['hidden'];
$correct_order_1 = $_POST['correct_order_1'];
$correct_order_2 = $_POST['correct_order_2'];
$correct_order_3 = $_POST['correct_order_3'];
$correct_order_4 = $_POST['correct_order_4'];
$link = ($_POST['link']);
$url = ($_POST['image-url1']);
$available = ($_POST['type']);
$orderType = ($_GET['ordertype']);
if($question == ''){
	echo "Question is empty";
	exit();
}
if($questionid == ''){
	echo "QuestionID is empty";
	exit();
}
if($modified == ''){
	echo "Invalid update type";
	exit();
}
if($correct_order_1 == ''){
	echo "correct_order_1 is empty";
	exit();
}
if($correct_order_2 == ''){
	echo "correct_order_1 is empty";
	exit();
}
if($correct_order_3 == ''){
	echo "correct_order_1 is empty";
	exit();
}
if($correct_order_4 == ''){
	echo "correct_order_1 is empty";
	exit();
}
if($available == ''){
	echo "Availablilty is not set";
	exit();
}
require_once('includes/db_conn.php');
$query_update = '';
$query_delete = '';
if($orderType == '1'){
	$query_update = "UPDATE `parkapps`.`orderQuestions` SET `question` = '".$question."', `link` = '".$link."', `image_url1` = '".$url."', `order1` = '".$correct_order_1."',`order2` = '".$correct_order_2."',`order3` = '".$correct_order_3."',`order4` = '".$correct_order_4."',`available` = '".$available."' WHERE `orderQuestions`.`questionid` = '".$questionid."';";
	$query_delete = "DELETE FROM `parkapps`.`orderQuestions` WHERE `orderQuestions`.`questionid` = '".$questionid."'";
}else if($orderType == '0'){
	$query_update = "UPDATE `parkapps`.`orderQuestions` SET `question` = '".$question."', `link` = '".$link."', `image1` = '".$correct_order_1."',`image2` = '".$correct_order_2."',`image3` = '".$correct_order_3."',`image4` = '".$correct_order_4."',`available` = '".$available."' WHERE `orderQuestions`.`questionid` = '".$questionid."';";
	$query_delete = "DELETE FROM `parkapps`.`orderQuestions` WHERE `orderQuestions`.`questionid` = '".$questionid."'";
}

if($modified == 'edit'){
	$result = $dbc->query($query_update);

	if($result){
	    echo "Information has been updated <br><a href='map.php'>Go Back</a>";
	} else {
	    echo '<h1>System Error</h1>';
	}
	$dbc->close();
}else if($modified == 'delete'){
	$result = $dbc->query($query_delete);

	if($result){
	    echo "Information has been removed <br><a href='map.php'>Go Back</a>";
	} else {
	    echo '<h1>System Error</h1>';
	}
	$dbc->close();
}

include('includes/footer.html');
?>