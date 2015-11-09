<?php
error_reporting(-1);
ini_set('display_errors', 'On');
$userid = $_POST['userid'];
$roleid = $_POST['roleid'];
//Check for empty fields
//Create short variables
$track_name = $_POST['track_name'];
$description = $_POST['description'];
$image1 = $_POST['image-url1'];
$available = $_POST['available'];
$point_order = $_POST['point_order'];
if (getimagesize($image1) == false) {//image not exist, change to default image
	$image1 = "http://parkapps.kent.edu/interpoSystem/AdventureTracks/images/default.jpg";
}
//connect to the database
require_once('includes/db_conn.php');
//Create the insert query
$query = "INSERT INTO AdventureTracks
			(ID,Track_Name, Description,available, Image_url,Point_Order)
			 VALUES (NULL, '".$track_name."','".$description."', '".$available."','".$image1."','".$point_order."')";
$result = $dbc->query($query);

if($result){
    echo "<script language=JavaScript> alert(\"Insert successfully!\"); window.location='list.php?userID=".$userid."&roleID=".$roleid."'</script>";
} else {
    echo '<h1>System Error</h1>';
}
$dbc->close();

//image uploading part--------------------


//---------------------

?>



