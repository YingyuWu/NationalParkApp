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
include('includes/listtop_test.html');
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
			echo "<li id='".$row['ID']."' onclick='go(this)'>
			<img style='width:300px;height:200px' src=".$row['Image_url']." />
			<h5>".$row['Track_Name']."</h5>
			<a href='main.php?userID=".$userid."&roleID=".$roleid."&trackType=".$row['ID']."'>Enter Track</a>
			<a href='main.php?userID=".$userid."&roleID=".$roleid."&trackType=".$row['ID']."'>Edit Track</a>
			</li>"; 
		}
	}
include('includes/listbottom_test.html');		
?>
<script type="text/javascript">
function go(ele){
	var user_id = <?php echo json_encode($userid); ?>;
  	var role_id = <?php echo json_encode($roleid); ?>;
  	var track_type = ele.id;
	var url = "main.php?userID="+ user_id + "&roleID="+ role_id + "&trackType=" + track_type;
	window.location = url;
}
function addTrack(){
	var user_id = <?php echo json_encode($userid); ?>;
  	var role_id = <?php echo json_encode($roleid); ?>;
	var url = "add_track.php?userID="+ user_id + "&roleID="+ role_id;
	window.location = url;
}
</script>



			