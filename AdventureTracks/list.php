<?php
$userid = $_GET['userID'];
if($userid == ''){
	echo "User ID is invalid";
	exit();
}
$roleid = $_GET['roleID'];
if($roleid == ''){
	echo "Role ID is invalid";
	exit();
}
include('includes/listtop.html');
	require_once('includes/db_conn.php');
	$query = "SELECT * FROM `AdventureTracks`";
	$result = $dbc->query($query);
	if(!$result){
		echo '<h1>System Error</h1>';
		exit();
	}

	if($result->num_rows > 0){
	//Fetch rows
		while($row = $result->fetch_assoc()){
			echo "<div class='view'>
			<div class='view-back'>
			<span style='color:white'data-icon=''><b>".$row['Track_Name']."</b></span>
			<a href='main.php?userID=".$userid."&roleID=".$roleid."&trackType=".$row['ID']."'>&rarr;</a>
			</div>
			<img style='width:300px;height:200px' src='".$row['Image_url']."' />
			</div>"; 
		}
	}
include('includes/listbottom.html');		
?>

			

            
				

