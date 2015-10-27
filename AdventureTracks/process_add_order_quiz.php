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
$correct_order_1 = $_POST['correct_order_1'];
$correct_order_2 = $_POST['correct_order_2'];
$correct_order_3 = $_POST['correct_order_3'];
$correct_order_4 = $_POST['correct_order_4'];
$locatid = $_POST['locatid'];
$type = $_GET['type'];
$link = $_POST['link'];

if($question == ''){
	echo "Question is empty";
	exit();
}
if($type == ''){
	echo "Order Type is invalid";
	exit();
}
if($correct_order_1 == ''){
	echo "correct_order_1 is empty";
	exit();
}
if($correct_order_2 == ''){
	echo "correct_order_2 is empty";
	exit();
}
if($correct_order_3 == ''){
	echo "correct_order_3 is empty";
	exit();
}
if($correct_order_4 == ''){
	echo "correct_order_4 is empty";
	exit();
}

//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = '';
if($type == '1'){
	$image1 = $_POST['image-url1'];
	$query = "INSERT INTO orderQuestions
			(questionid, question, order1, order2,order3,order4, available, Locat_ID,image_url1,link,type, Question_Type, Track_Type)
			 VALUES (NULL, '".$question."','".$correct_order_1."','".$correct_order_2."','".$correct_order_3."','".$correct_order_4."','1','".$locatid."','".$image1."','".$link."','".$type."','1','".$track_type."')";
			 
}else if($type == '0'){
	$query = "INSERT INTO orderQuestions
			(questionid, question, order1,order2,order3,order4,available, Locat_ID,link,type, Question_Type, Track_Type)
			 VALUES (NULL, '".$question."','".$correct_order_1."','".$correct_order_2."','".$correct_order_3."','".$correct_order_4."','1', '".$locatid."','".$link."','".$type."','1','".$track_type."')";
}
if($query == ''){
	echo "Query is invalid";
	exit();
}
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
function viewIntroduction(ele){
    window.location = "main.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
}
</script>

