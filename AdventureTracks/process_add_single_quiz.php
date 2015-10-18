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
if($response == ''){
	echo "Response for correct answer is empty";
	exit();
}
if($response_wrong == ''){
	echo "Response for wrong answer is empty";
	exit();
}
//NEED TO CHECK INVALID INPUT TODO
//$correct_answer = preg_replace('/\s+/', '_', $correct_answer);
 //$strlen = strlen( $correct_answer );
 //echo $strlen;
//for( $i = 0; $i <= $strlen; $i++ ) {
  //  $char = substr( $str, $i, 1 );
    // if( ! is_numeric( $char ) ) { 
     //	echo "Invalid correct_answer, must be numbers;" exit(); 
     //}
//}


//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO singleQuestions
			(questionid, question, correct_answer,available, Locat_ID,image_url1,link,options,response,response_wrong, Question_Type, Track_Type)
			 VALUES (NULL, '".$question."','".$correct_answer."','1', '".$locatid."','".$image1."','".$link."','".$options."','".$response."','".$response_wrong."','1','".$track_type."')";
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

