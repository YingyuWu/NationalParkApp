<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'On');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
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
if($locatid == ''){
	echo "Location ID is invalid";
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
			(questionid, question, order1, order2,order3,order4, available, Locat_ID,image_url1,link,type)
			 VALUES (NULL, '".$question."','".$correct_order_1."','".$correct_order_2."','".$correct_order_3."','".$correct_order_4."','1','".$locatid."','".$image1."','".$link."','".$type."')";
			 
}else if($type == '0'){
	$query = "INSERT INTO orderQuestions
			(questionid, question, image1,image2,image3,image4,available, Locat_ID,link,type)
			 VALUES (NULL, '".$question."','".$correct_order_1."','".$correct_order_2."','".$correct_order_3."','".$correct_order_4."','1', '".$locatid."','".$link."','".$type."')";
}
if($query == ''){
	echo "Query is invalid";
	exit();
}
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

