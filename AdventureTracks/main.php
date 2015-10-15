<?php
include('includes/header.html');
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
$track_type = $_GET['trackType'];
if($track_type == ''){
  $track_type = 1;
}
require_once('includes/db_conn.php');
$query1 = "SELECT * FROM `AdventureTracksPoints` WHERE User_ID = '".$userid."' AND Track_Type = '".$track_type."'";
$query2 = "SELECT * FROM `AdventureTracks` WHERE ID = '".$track_type."'";//Default Setting for index page
$result = $dbc->query($query2);
if(!$result){
        echo '<h1>System Error</h1>';
        exit();
}
if($result->num_rows > 0){
        //Fetch rows
        while($row = $result->fetch_assoc()){
            $track_name = $row['Track_Name'];
            $track_description = $row['Description'];  
        }
}
?>
<script type="text/javascript">
function init(){
  var user_id = <?php echo json_encode($userid); ?>;
  var role_id = <?php echo json_encode($roleid); ?>;
  var track_type = <?php echo json_encode($track_type); ?>;
  var description = <?php echo json_encode($track_description ); ?>;
  document.getElementById("user-id").value = user_id;
  document.getElementById("role-id").value = role_id;
  document.getElementById("track-type").value = track_type;
  document.getElementById("header-user-id").value = user_id;
  document.getElementById("header-role-id").value = role_id;
  document.getElementById("main-content").innerHTML = "<h1 class='description'><b>Description</b></h1>" + description;
  //document.getElementById("main-content").style.backgroundImage = "url('images/ledgesWeathering_background.png')";
}
  
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
    <title>Adventure Tracks</title> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/show_question.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body onload="init()">
<div class="main"> 
	<div class="left">
	     <ul>
       <li><a onclick="viewPoints(this)">Points</a></li>
       <li><a>Text/Image Questions</a></li>
       <li><a>Fill In Questions</a></li>
       <li><a>Single Choice Questions</a></li>
       <li><a>Multiple Choice Questions</a></li>
       <li><a>Match Questions</a></li>
       <li><a>Correct Order Questions</a></li>
       <li><a>Information</a></li>
       </ul>
	</div>
	<div class="wrappermiddle">
		<div class="middle" id="main-content">

	</div>    
	<!--<div class="right">
	    Right column: 
	     <br>
	     fixed width 200 px 
	</div>  -->   
</div>
<input type="hidden" name="user_id" value="hidden" id="user-id">
<input type="hidden" name="role_id" value="hidden" id="role-id">
<input type="hidden" name="track_type" value="hidden" id="track-type">
</body>
</html>
<?php include('includes/footer.html') ?>
<script type="text/javascript">
function viewPoints(ele){
  var userid = document.getElementById("user-id").value;
  var roleid = document.getElementById("role-id").value;
  var track_type = document.getElementById("track-type").value;
  var url = "map.php?userID=" + userid + "&roleID=" + roleid + "&trackType=" + track_type;
  window.location = url;
}
</script>