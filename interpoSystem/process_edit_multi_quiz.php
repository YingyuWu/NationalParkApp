<?php
error_reporting(-1);
ini_set('display_errors', 'off');
include('includes/header.html');
//Check for empty fields
//Create short variables
$question = $_POST['question'];
$questionid = $_POST['questionid'];
$modified = $_POST['hidden'];
$options = $_POST['options'];
$correct_answer = ($_POST['correct_answer']);
$response = ($_POST['response']);
$link = ($_POST['link']);
$url = ($_POST['image-url1']);
//$input = ($_POST['user_input']);
$available = ($_POST['type']);
$response_wrong = ($_POST['response_wrong']);
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
if($correct_answer == ''){
	echo "correct_answer is empty";
	exit();
}
if($options == ''){
	echo "options is empty";
	exit();
}
if($available == ''){
	echo "Availablilty is not set";
	exit();
}
if($response == ''){
	echo "Response for correct answers is not set";
	exit();
}
if($response_wrong == ''){
	echo "Response for wrong answers is empty";
	exit();
}
require_once('includes/db_conn.php');
//,`user_input` = '".$input."'
$query_update = "UPDATE `parkapps`.`multiQuestions` SET `question` = '".$question."', `link` = '".$link."', `image_url1` = '".$url."',`available` = '".$available."',`correct_answer` = '".$correct_answer."',`options` = '".$options."',`response` = '".$response."' ,`response_wrong` = '".$response_wrong."' WHERE `multiQuestions`.`questionid` = '".$questionid."';";
$query_delete = "DELETE FROM `parkapps`.`multiQuestions` WHERE `multiQuestions`.`questionid` = '".$questionid."'";
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