<?php
error_reporting(-1);
ini_set('display_errors', 'off');
include('includes/header.html');
//Check for empty fields
//Create short variables
$question = $_POST['question'];
$questionid = $_POST['questionid'];
$modified = $_POST['hidden'];
$link = ($_POST['link']);
$url = ($_POST['image-url1']);
$available = ($_POST['type']);
if($question == ''){
	echo "Information is empty";
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
if($available == ''){
	echo "Availablilty is not set";
	exit();
}
require_once('includes/db_conn.php');
$query_update = "UPDATE `parkapps`.`factInformation` SET `question` = '".$question."', `link` = '".$link."', `image_url1` = '".$url."',`available` = '".$available."' WHERE `factInformation`.`questionid` = '".$questionid."';";
$query_delete = "DELETE FROM `parkapps`.`factInformation` WHERE `factInformation`.`questionid` = '".$questionid."'";
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