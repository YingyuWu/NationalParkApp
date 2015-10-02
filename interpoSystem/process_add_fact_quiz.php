<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'On');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
//Check for empty fields

//Create short variables
$question = $_POST['question'];
$locatid = $_POST['locatid'];
$image1 = $_POST['image-url1'];
$link = $_POST['link'];

if($question == ''){
	echo "Question is empty";
	exit();
}
if($locatid == ''){
	echo "Location ID is invalid";
	exit();
}
//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO factInformation
			(questionid, question,available, Locat_ID,image_url1,link)
			 VALUES (NULL, '".$question."','1', '".$locatid."','".$image1."','".$link."')";
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

