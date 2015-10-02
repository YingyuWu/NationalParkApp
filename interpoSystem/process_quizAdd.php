<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'On');

//Check for empty fields

//Create short variables
$question = $_POST['question'];
$locatid = $_POST['locatid'];
$image1 = $_POST['image-url1'];
$link = $_POST['link'];

$correct_answer = ($_POST['correct_answer']);
if($question == ''){
	echo "Question is empty";
	exit();
}
if($correct_answer == ''){
	echo "Correct answer is emtpy";
	exit();
}
//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO questions
			(questionid, question, answer,available, Locat_ID,image_url1,link)
			 VALUES (NULL, '".$question."','".$correct_answer."','1', '".$locatid."','".$image1."','".$link."')";
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

