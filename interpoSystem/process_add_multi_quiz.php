<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'On');

//Check for empty fields

//Create short variables
$question = $_POST['question'];
$options = $_POST['options'];
$correct_answer = $_POST['correct_answer'];
$locatid = $_POST['locatid'];
$image1 = $_POST['image-url1'];
$link = $_POST['link'];
$response = $_POST['response'];
$response_wrong = $_POST['response_wrong'];
if($question == ''){
	echo "Question is empty";
	exit();
}
if($options == ''){
	echo "Options are emtpy";
	exit();
}
if($correct_answer == ''){
	echo "Correct answer is emtpy";
	exit();
}

if($locatid == ''){
	echo "Location ID is invalid";
	exit();
}
if($response == ''){
	echo "Response for correct answers is empty";
	exit();
}
if($response_wrong == ''){
	echo "Response for wrong answers is empty";
	exit();
}

//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO multiQuestions
			(questionid, question, correct_answer,available, Locat_ID,image_url1,link,options,response,response_wrong)
			 VALUES (NULL, '".$question."','".$correct_answer."','1', '".$locatid."','".$image1."','".$link."','".$options."','".$response."','".$response_wrong."')";
$result = $dbc->query($query);

if($result){
    echo "Information has been saved";
} else {
    echo '<h1>System Error</h1>';
}
$dbc->close();

//image uploading part--------------------


//---------------------

include('includes/footer.html');
?>

