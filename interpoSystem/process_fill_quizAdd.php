<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'off');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];

//Create short variables]
$question = ($_POST['question']);
$answer_s = ($_POST['answer-short']);
$answer_l = ($_POST['answer-long']);
$link = ($_POST['link']);
$url = ($_POST['image-url1']);
$locatid = $_POST['locatid'];
if($question == '' || $answer_s == '' || $answer_l == ''){
	echo "Information Empty";
	exit();
}
if($locatid == ''){
	echo "Location Invalid";
	exit();
}
//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO FillQuestions
			(questionid, question, answer_short, answer_long, link, image_url1, Locat_ID, available)
			 VALUES (NULL, '".$question."','".$answer_s."','".$answer_l."','".$link."','".$url."','".$locatid."','1')";

$result = $dbc->query($query);

if($result){
    echo "Information has been saved<br><a href='map.php?userID=".$userid."&roleID=".$roleid."'>Go Back</a>";
} else {
    echo '<h1>System Error</h1>';
}
$dbc->close();

//image uploading part--------------------


//---------------------

include('includes/footer.html');
?>

