<?php
error_reporting(-1);
ini_set('display_errors', 'off');
include('includes/header.html');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
//Check for empty fields
//Create short variables
$question = $_POST['question'];
$questionid = $_POST['questionid'];
$left_options = $_POST['left_options'];
$right_options = $_POST['right_options'];
$left_title = $_POST['left_title'];
$right_title = $_POST['right_title'];
$image1 = $_POST['image-url1'];
$link = $_POST['link'];
$response = $_POST['response'];
$response_wrong = $_POST['response_wrong'];
$modified = $_POST['hidden'];
$available = $_POST['type'];
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
if($response == ''){
	echo "Response for correct answers is empty";
	exit();
}
if($response_wrong == ''){
	echo "Response for wrong answers is empty";
	exit();
}
if($available == ''){
	echo "Availability is empty";
	exit();
}
require_once('includes/db_conn.php');
//,`user_input` = '".$input."'
$query_update = "UPDATE `parkapps`.`matchQuestions` SET `question` = '".$question."', `link` = '".$link."', `image_url1` = '".$url."',`available` = '".$available."',`left_title` = '".$left_title."',`left_options` = '".$left_options."',`right_title` = '".$right_title."',`right_options` = '".$right_options."',`response` = '".$response."' ,`response_wrong` = '".$response_wrong."' WHERE `matchQuestions`.`questionid` = '".$questionid."';";
$query_delete = "DELETE FROM `parkapps`.`matchQuestions` WHERE `matchQuestions`.`questionid` = '".$questionid."'";
if($modified == 'edit'){
	$result = $dbc->query($query_update);

	if($result){
	    echo "Information has been saved<br><a href='map.php?userID=".$userid."&roleID=".$roleid."'>Go Back</a>";
	} else {
	    echo '<h1>System Error</h1>';
	}
	$dbc->close();
}else if($modified == 'delete'){
	$result = $dbc->query($query_delete);

	if($result){
	    echo "Information has been saved<br><a href='map.php?userID=".$userid."&roleID=".$roleid."'>Go Back</a>";
	} else {
	    echo '<h1>System Error</h1>';
	}
	$dbc->close();
}

include('includes/footer.html');
?>

<script type="text/javascript">
var user_id = <?php echo json_encode($userid); ?>;
var role_id = <?php echo json_encode($roleid); ?>;
document.getElementById("header-user-id").value = user_id;
document.getElementById("header-role-id").value = role_id;
</script>