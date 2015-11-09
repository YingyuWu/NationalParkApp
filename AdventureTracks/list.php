<style>
a:hover {
  cursor:pointer;
  
 }
</style>
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
	if($roleid == '1'|| $roleid == '2'){
		$query = "SELECT * FROM `AdventureTracks`";
	}else{//normal
		$query = "SELECT * FROM `AdventureTracks` WHERE available='1' ";
	}
	$result = $dbc->query($query);
	if(!$result){
		echo '<h1>System Error</h1>';
		exit();
	}

	if($result->num_rows > 0){
	//Fetch rows
		while($row = $result->fetch_assoc()){
			if($roleid == '1' || $roleid == '2'){//admin,citizen
				if($row['available'] == '1'){
					$option = 'Hide Track';
				}else{//normal user
					$option = 'Show Track';
				}//onclick='go(this)'
				echo "<li id='".$row['ID']."' >
				<img style='width:300px;height:180px' src=".$row['Image_url']." />
				<h4>".$row['Track_Name']."</h4>
				<a name='".$row['ID']."' href='main.php?userID=".$userid."&roleID=".$roleid."&trackType=".$row['ID']."'>Enter Track</a>&nbsp;&nbsp;&nbsp;
				<a href='edit_track.php?userID=".$userid."&roleID=".$roleid."&trackType=".$row['ID']."'>Edit Track</a>&nbsp;&nbsp;&nbsp;
				<a name='".$row['ID']."' id='".$row['available']."' onclick='setTrackAvailable(this)' style='color:blue;text-decoration: underline;'>".$option."</a>
				</li>";
				
			}else{
				echo "<li id='".$row['ID']." onclick='go(this)' >
				<img style='width:300px;height:200px' src=".$row['Image_url']." />
				<h4>".$row['Track_Name']."</h4>
				<a name='".$row['ID']."' href='main.php?userID=".$userid."&roleID=".$roleid."&trackType=".$row['ID']."'>Enter Track</a>&nbsp;&nbsp;&nbsp;
				</li>"; 
				
			}
			
		}
	}
include('includes/listbottom.html');		
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
var role_id = <?php echo json_encode($roleid); ?>;
if(role_id == '1' || role_id == '2'){
	document.getElementById("header1").style.display = "none";
	document.getElementById("header0").style.display = "block";
}else{
	document.getElementById("header0").style.display = "none";
	document.getElementById("header1").style.display = "block";
}
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
function setTrackAvailable(ele){
	var user_id = <?php echo json_encode($userid); ?>;
  	var role_id = <?php echo json_encode($roleid); ?>;
	 $.ajax({ url: 'process_hide_track_quiz.php',
               data: {trackType: ele.name, available:ele.id},
               type: 'post',
               success: function(output) {
					alert("Edit Successfully!");
                     window.location='list.php?userID='+ user_id +'&roleID=' + role_id;
                }
      });
	
	
	
}
</script>



			