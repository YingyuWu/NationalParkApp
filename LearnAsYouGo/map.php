<?php
include('includes/header.html');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
    <title>Google Maps Javascript API v3 Example: Adding a clickable sidebar</title> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/show_question.css">
<script type="text/javascript">

jQuery(function($){
  $('#question1').load('answer.html #question1');
});
</script>
<style type="text/css">
html, body { height: 100%; } 
 
</style>
<?php
require_once('includes/db_conn.php');
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
$query = "SELECT * FROM `Location` WHERE (User_ID = '".$userid."' OR User_ID='1') AND Pub_Or_Priva = '1'";//AND (Location_type = '0' OR Location_type = '3')
$result = $dbc->query($query);
$count = 0;
$lat = array();
$lnt = array();
$locat_id = array();
$location_type = array();
$title = array();
if(!$result){
        echo '<h1>System Error</h1>';
        exit();
}
if($result->num_rows > 0){
        //Fetch rows
        while($row = $result->fetch_assoc()){
            $lat[$count] = $row['Latitude'];
            $lnt[$count] = $row['Longitude'];
            $locat_id[$count] = $row['ID'];
			$location_type[$count] = $row['Location_type'];
			$title[$count] = $row['Title'];
            $count++;   
        }
}else{
    echo "<p>No results matching</p>";
}
if(count($lat) != count($lnt)){
  echo "<p>Locations loading error</p>";
  exit();
}
$dbc->close();
?>

<script type="text/javascript"> 

//<![CDATA[
      // this variable will collect the html which will eventually be placed in the side_bar 
      var side_bar_html = ""; 
    
      // arrays to hold copies of the markers and html used by the side_bar 
      // because the function closure trick doesnt work there 
      var gmarkers = []; 
      var map = null;
	  
  var lats = <?php echo json_encode($lat); ?>;//all the points from database
  var lnts = <?php echo json_encode($lnt); ?>;
  var locat_id = <?php echo json_encode($locat_id); ?>;
  var user_id = <?php echo json_encode($userid); ?>;
  var role_id = <?php echo json_encode($roleid); ?>;
  var location_type = <?php echo json_encode($location_type); ?>;
  var title = <?php echo json_encode($title); ?>;
document.getElementById("menu_map").style.backgroundColor = "#6F74B9";
</script> 
<script src="js/map.js"></script>
  </head> 



<body style="margin-top:100px; margin-left:100px; padding:0px;" > 
 <div><img src="images/learnPoints.png">&nbsp;Learn As You Go Points&nbsp;&nbsp;&nbsp;<img src="images/generalPoints.png">&nbsp;Information Points&nbsp;&nbsp;<img src="images/adventurePoints.png">&nbsp;Adventure Tracks Points</div>
    <!-- you can use tables or divs for the overall layout --> 
   <div style="width:100%; height:700px;margin:0 auto;border: 2px solid black;">
   
           <div id="map_canvas" style="width: 50%; height: 100%;float:left;border-right: 1px solid black;"></div> 
          <div id="side_bar" style="width:50%; height:100%; overflow-y:auto; "></div> 
    </div>
    <br>
    <div style="margin:0 auto; width:100%;">
    <b>Point Filter: </b><input type = "text" id="filter" placeholder="Enter Point ID"> &nbsp;&nbsp;&nbsp;<input type="button" value="GO" onclick="filterPoints()">
    </div>
    <input type="hidden" name="locat_id" id="locat-id" value="hidden">
    <input type="hidden" name="user_id" value="hidden" id="user-id">
    <input type="hidden" name="role_id" value="hidden" id="role-id">
  </body> 
</html> 
<script type="text/javascript">

  $(document).ready(function(){
    initialize();
  });


</script>

<?php include('includes/footer.html') ?>
