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

$correct_answer = ($_POST['correct_answer']);
if($question == ''){
	echo "Question is empty";
	exit();
}
if($correct_answer == ''){
	echo "Correct answer is emtpy";
	exit();
}
//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO questions
			(questionid, question, answer,available, Locat_ID,image_url1,link)
			 VALUES (NULL, '".$question."','".$correct_answer."','1', '".$locatid."','".$image1."','".$link."')";
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
