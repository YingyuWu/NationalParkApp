<?php
error_reporting(-1);
ini_set('display_errors', 'On');
$track_type = $_POST['trackType'];
$available = $_POST['available'];
//Check for empty fields
//Create short variables
//connect to the database
require_once('includes/db_conn.php');
//Create the insert query
if($available == '1'){
	$query = "UPDATE `parkapps`.`AdventureTracks` SET `available` = '0' WHERE ID='".$track_type."'";
}else{
	$query = "UPDATE `parkapps`.`AdventureTracks` SET `available` = '1' WHERE ID='".$track_type."'";
}

$result = $dbc->query($query);

if($result){
    //echo "<script language=JavaScript> alert(\"Edit successfully!\"); window.location='list.php?userID=".$userid."&roleID=".$roleid."'</script>";
} else {
    echo '<h1>System Error</h1>';
}
$dbc->close();

//image uploading part--------------------


//---------------------

?>



