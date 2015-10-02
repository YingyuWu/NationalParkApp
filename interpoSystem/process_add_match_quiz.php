<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'On');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
//Check for empty fields

//Create short variables
$question = $_POST['question'];
$left_options = $_POST['left_options'];
$right_options = $_POST['right_options'];
$left_title = $_POST['left_title'];
$right_title = $_POST['right_title'];
$locatid = $_POST['locatid'];
$image1 = $_POST['image-url1'];
$link = $_POST['link'];
$response = $_POST['response'];
$response_wrong = $_POST['response_wrong'];
if($question == ''){
	echo "Question is empty";
	exit();
}
if($right_options == ''){
	echo "Right options are emtpy";
	exit();
}
if($left_options == ''){
	echo "Left options is emtpy";
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
$query = "INSERT INTO matchQuestions
			(questionid, question, left_options, right_options, left_title, right_title, available, Locat_ID,image_url1,link,response,response_wrong)
			 VALUES (NULL, '".$question."','".$left_options."','".$right_options."','".$left_title."','".$right_title."','1', '".$locatid."','".$image1."','".$link."','".$response."','".$response_wrong."')";
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
<script type="text/javascript">
var user_id = <?php echo json_encode($userid); ?>;
var role_id = <?php echo json_encode($roleid); ?>;
document.getElementById("header-user-id").value = user_id;
document.getElementById("header-role-id").value = role_id;
</script>
