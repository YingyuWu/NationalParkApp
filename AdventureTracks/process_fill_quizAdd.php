<?php
include('includes/header.html');
include('includes/left_menu.html');
error_reporting(-1);
ini_set('display_errors', 'off');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
$track_type = $_POST['track_type'];
if($track_type == ''){
	echo "Track Type is Empty";
	exit();
}
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
//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO FillQuestions
			(questionid, question, answer_short, answer_long, link, image_url1, Locat_ID, available ,Question_Type, Track_Type)
			 VALUES (NULL, '".$question."','".$answer_s."','".$answer_l."','".$link."','".$url."','".$locatid."','1','1','".$track_type."')";

$result = $dbc->query($query);

if($result){
    echo "<div class='wrappermiddle'>
        <div class='middle' id='main-content'>Information has been saved<br><a href='main.php?userID=".$userid."&roleID=".$roleid."&trackType=".$track_type."'>Go Back</a>
        </div></div>";
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
</script>
