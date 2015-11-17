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
$locatid = $_POST['locat_id'];
$image1 = $_POST['image-url1'];
$link = $_POST['link'];

if($question == ''){
	echo "Question is empty";
	exit();
}
//connect to the database
require_once('includes/db_conn.php');
$query = "SELECT * FROM `AdventureTracks` WHERE ID='".$track_type."'";
$result = $dbc->query($query);
$track_name;
    if(!$result){
        echo '<h1>System Error</h1>';
        exit();
    }

    if($result->num_rows > 0){
    //Fetch rows
        $row = $result->fetch_assoc();
        $track_name = $row['Track_Name'];
    }
//Create the insert query
$query = "INSERT INTO factInformation
			(questionid, question,available, Locat_ID,image_url1,link, Question_Type, Track_Type)
			 VALUES (NULL, '".$question."','1', '".$locatid."','".$image1."','".$link."','1','".$track_type."')";
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
var track_name = <?php echo json_encode($track_name); ?>;
document.getElementById("track-name").innerHTML = track_name;
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
function switchTracks(ele){
    window.location = "list.php?userID=" + user_id + "&roleID=" + role_id;
}
function viewIntroduction(ele){
    window.location = "main.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
}
</script>

