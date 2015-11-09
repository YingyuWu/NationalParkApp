<?php
error_reporting(-1);
ini_set('display_errors', 'On');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
$track_type = $_POST['track_type'];
//Check for empty fields
//Create short variables
$track_name = $_POST['track_name'];
$description = $_POST['description'];
$image1 = $_POST['image-url1'];
$available = $_POST['available'];
$point_order = $_POST['point_order'];
if (getimagesize($image1) == false) {//image not exists, change to default
	$image1 = "http://parkapps.kent.edu/interpoSystem/AdventureTracks/images/default.jpg";
}
//connect to the database
require_once('includes/db_conn.php');
//Create the insert query
$query = "UPDATE `parkapps`.`AdventureTracks` SET `Track_Name` = '".$track_name."', `Description` = '".$description."', `Image_url` = '".$image1."',`available` = '".$available."',`Point_Order` = '".$point_order."' WHERE ID='".$track_type."'";
$result = $dbc->query($query);

if($result){
    echo "<script language=JavaScript> alert(\"Edit successfully!\"); window.location='list.php?userID=".$userid."&roleID=".$roleid."'</script>";
} else {
    echo '<h1>System Error</h1>';
}
$dbc->close();

//image uploading part--------------------


//---------------------

?>



