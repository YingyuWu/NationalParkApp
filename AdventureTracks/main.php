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
$query1 = "SELECT count(*) FROM `Location` INNER JOIN `AdventureTracksPoints` WHERE `AdventureTracksPoints`.Locat_ID=`Location`.ID AND `Location`.User_ID = '".$userid."' AND `AdventureTracksPoints`.Track_Type = '".$track_type."' AND `Location`.Pub_Or_Priva = '1' ORDER BY `Location`.ID";
$query3 = "SELECT count(*) FROM `questions` INNER JOIN `Location`WHERE `questions`.Locat_ID=`Location`.ID AND `questions`.Question_Type='1' AND `questions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."'";
$query4 = "SELECT count(*) FROM `FillQuestions` INNER JOIN `Location`WHERE `FillQuestions`.Locat_ID=`Location`.ID AND `FillQuestions`.Question_Type='1' AND `FillQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."'";
$query5 = "SELECT count(*) FROM `singleQuestions` INNER JOIN `Location`WHERE `singleQuestions`.Locat_ID=`Location`.ID AND `singleQuestions`.Question_Type='1' AND `singleQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."'";
$query6 = "SELECT count(*) FROM `multiQuestions` INNER JOIN `Location`WHERE `multiQuestions`.Locat_ID=`Location`.ID AND `multiQuestions`.Question_Type='1' AND `multiQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."'";
$query7 = "SELECT count(*) FROM `matchQuestions` INNER JOIN `Location`WHERE `matchQuestions`.Locat_ID=`Location`.ID AND `matchQuestions`.Question_Type='1' AND `matchQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."'";
$query8 = "SELECT count(*) FROM `orderQuestions` INNER JOIN `Location`WHERE `orderQuestions`.Locat_ID=`Location`.ID AND `orderQuestions`.Question_Type='1' AND `orderQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."'";
$query9 = "SELECT count(*) FROM `factInformation` INNER JOIN `Location`WHERE `factInformation`.Locat_ID=`Location`.ID AND `factInformation`.Question_Type='1' AND `factInformation`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."'";
$result=$dbc->query($query1);
$row = $result->fetch_assoc();
$points=$row['count(*)'];
$result=$dbc->query($query3);
$row = $result->fetch_assoc();
$num_text=$row['count(*)'];
$result=$dbc->query($query4);
$row = $result->fetch_assoc();
$num_fill=$row['count(*)'];
$result=$dbc->query($query5);
$row = $result->fetch_assoc();
$num_single=$row['count(*)'];
$result=$dbc->query($query6);
$row = $result->fetch_assoc();
$num_multi=$row['count(*)'];
$result=$dbc->query($query7);
$row = $result->fetch_assoc();
$num_match=$row['count(*)'];
$result=$dbc->query($query8);
$row = $result->fetch_assoc();
$num_order=$row['count(*)'];
$result=$dbc->query($query9);
$row = $result->fetch_assoc();
$num_fact=$row['count(*)'];
$dbc->close();
?>
<script type="text/javascript" src="js/canvasjs.min.js"></script>
<script type="text/javascript" src="js/wow.js"></script>
<script>
    new WOW().init();//For speeding up the loading time of webpage
</script>
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
  chartRender();
  //document.getElementById("main-content").style.backgroundImage = "url('images/ledgesWeathering_background.png')";
}

function chartRender(){
var points=<?php echo json_encode($points); ?>;
var num_text=<?php echo json_encode($num_text); ?>;
var num_fill=<?php echo json_encode($num_fill); ?>;
var num_single=<?php echo json_encode($num_single); ?>;
var num_multi=<?php echo json_encode($num_multi); ?>;
var num_match=<?php echo json_encode($num_match); ?>;
var num_order=<?php echo json_encode($num_order); ?>;
var num_fact=<?php echo json_encode($num_fact); ?>;
  var chart = new CanvasJS.Chart("chartContainer",
  {
    theme: "theme2",
    title:{
      text: "'Numbers in this track'"
    },    
    data: [
    {       
      type: "pie",
      showInLegend: true,
      toolTipContent: "{y}",
      legendText: "{indexLabel}",
      dataPoints: [
        {  y: points, indexLabel: "points" },
        {  y: num_text, indexLabel: "text/image questions" },
        {  y: num_fill, indexLabel: "fill in questions" },
        {  y: num_single, indexLabel: "single choice questions"},
        {  y: num_multi, indexLabel: "multiple choices questions" },
        {  y: num_match, indexLabel: "match questions"},
        {  y: num_order, indexLabel: "correct order questions"},
        {  y: num_fact, indexLabel: "information"}
      ]
    }
    ]
  });
  chart.render();
}
  
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
    <title>Adventure Tracks</title> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
</head>
<body onload="init()">
<?php include('includes/left_menu.html'); ?>
	<div class="wrappermiddle">
		<div style="width:50%; float:left;border-right:1px solid grey" class="middle" id="main-content">

	</div>
  <div style="width:50%;float:left" class="wow fadeIn" id="chartContainer">

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

function viewQuestions(ele){
  var roleid = document.getElementById("role-id").value;
  var userid = document.getElementById("user-id").value;
  var track_type = document.getElementById("track-type").value;
  var type = ele.name;
  var url = "show_questions.php?userID=" + userid + "&roleID=" + roleid + "&trackType=" + track_type + "&Type=" + type;
  window.location = url;
}
</script>