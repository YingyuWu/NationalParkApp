<?php
error_reporting(-1);
ini_set('display_errors', 'off');
include('includes/header.html');
include('includes/left_menu.html');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
$track_type = $_POST['track_type'];
if($track_type == ''){
	echo "Track Type is Empty";
	exit();
}
$locatid = $_POST['locat_id'];
//Check for empty fields
//Create short variables
$question = $_POST['question'];
$questionid = $_POST['questionid'];
$modified = $_POST['hidden'];
$answer_short = ($_POST['answer_short']);
$answer_long = ($_POST['answer_long']);
$link = ($_POST['link']);
$url = ($_POST['image-url1']);
//$input = ($_POST['user_input']);
$available = ($_POST['type']);
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
if($answer_short == ''){
	echo "answer_short is empty";
	exit();
}
if($answer_long == ''){
	echo "answer_long is empty";
	exit();
}
if($available == ''){
	echo "Availablilty is not set";
	exit();
}
//`user_input` = '".$input."',
require_once('includes/db_conn.php');
//,`user_input` = '".$input."'
$query_update = "UPDATE `parkapps`.`FillQuestions` SET `question` = '".$question."', `link` = '".$link."', `image_url1` = '".$url."', `available` = '".$available."',`answer_short` = '".$answer_short."',`answer_long` = '".$answer_long."', `Locat_ID` = '".$locatid."'WHERE `FillQuestions`.`questionid` = '".$questionid."';";
$query_delete = "DELETE FROM `parkapps`.`FillQuestions` WHERE `FillQuestions`.`questionid` = '".$questionid."'";
if($modified == 'edit'){
	$result = $dbc->query($query_update);

	if($result){
	    echo "<div class='wrappermiddle'>
        <div class='middle' id='main-content'>Information has been saved<br><a href='main.php?userID=".$userid."&roleID=".$roleid."&trackType=".$track_type."'>Go Back</a>
        </div></div>";
	} else {
	    echo '<h1>System Error</h1>';
	}
	$dbc->close();
}else if($modified == 'delete'){
	$result = $dbc->query($query_delete);

	if($result){
	    echo "<div class='wrappermiddle'>
        <div class='middle' id='main-content'>Information has been saved<br><a href='main.php?userID=".$userid."&roleID=".$roleid."&trackType=".$track_type."'>Go Back</a>
        </div></div>";
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
var track_type = <?php echo json_encode($track_type); ?>;
document.getElementById("header-user-id").value = user_id;
document.getElementById("header-role-id").value = role_id;

function viewQuestions(ele){
  var type = ele.name;
  var url = "show_questions.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type + "&Type=" + type;
  window.location = url;
}

function viewPoints(ele){
  var url = "map.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
  window.location = url;
}
</script>