<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'On');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
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

if($locatid == ''){
	echo "Location ID is invalid";
	exit();
}

//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO singleQuestions
			(questionid, question, correct_answer,available, Locat_ID,image_url1,link,options,response,response_wrong)
			 VALUES (NULL, '".$question."','".$correct_answer."','1', '".$locatid."','".$image1."','".$link."','".$options."','".$response."','".$response_wrong."')";
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

