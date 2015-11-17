<?php
include('includes/header.html');
include('includes/left_menu.html');
error_reporting(-1);
ini_set('display_errors', 'On');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
$track_type = $_POST['track_type'];
if($track_type == ''){
	echo "Track Type is Empty";
	exit();
}
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
			(questionid, question, left_options, right_options, left_title, right_title, available, Locat_ID,image_url1,link,response,response_wrong, Question_Type, Track_Type)
			 VALUES (NULL, '".$question."','".$left_options."','".$right_options."','".$left_title."','".$right_title."','1', '".$locatid."','".$image1."','".$link."','".$response."','".$response_wrong."','1','".$track_type."')";
$result = $dbc->query($query);

if($result){
   echo "<script type='text/javascript'>alert('Insert Successfully!'); window.history.go(-2);</script>";
	    /*echo "<div class='wrappermiddle'>
        <div class='middle' id='main-content'>Information has been saved<br><a href='main.php?userID=".$userid."&roleID=".$roleid."&trackType=".$track_type."'>Go Back</a>
        </div></div>";*/
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
function viewIntroduction(ele){
    window.location = "main.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
}
</script>
