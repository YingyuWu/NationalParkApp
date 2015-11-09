<?php
include('includes/header.html');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
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
$track_type = $_GET['trackType'];
if($track_type == ''){
    echo "track_type is invalid";
    exit();
}
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
$query = "SELECT * FROM `Location`  WHERE User_ID = '".$userid."' AND `Location`.Pub_Or_Priva = '1'";
$result = $dbc->query($query);
$count = 0;
$lat = array();
$lnt = array();
$locat_id = array();
$descriptions = array();
$titles = array();
$tracktypes = array();
$locationtypes = array();
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
            $titles[$count] = $row['Title'];
            $descriptions[$count] = $row['Description'];
            $locationtypes[$count] = $row['Location_type'];
            $tracktypes[$count] = $row['Track_type'];
            $count++;   
        }
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
      var right_bar_html = "";
    
      // arrays to hold copies of the markers and html used by the side_bar 
      // because the function closure trick doesnt work there 
      var gmarkers = []; 
      var map = null;
      var lats;
      var lnts;
      var titles;
      var descriptions;
      var locat_id;
      var track_type;
      var user_id;
      var role_id;
      var tracktypes;
      var locationtypes;
  lats = <?php echo json_encode($lat); ?>;//all the points from database
  lnts = <?php echo json_encode($lnt); ?>;
  titles = <?php echo json_encode($titles); ?>;
  descriptions = <?php echo json_encode($descriptions); ?>;
  locat_id = <?php echo json_encode($locat_id); ?>;
  user_id = <?php echo json_encode($userid); ?>;
  role_id = <?php echo json_encode($roleid); ?>;
  track_type = <?php echo json_encode($track_type); ?>;//current track
  locationtypes = <?php echo json_encode($locationtypes); ?>;//array of location types for all points
  tracktypes = <?php echo json_encode($tracktypes); ?>;//array of trackstypes for all points
  var track_name = <?php echo json_encode($track_name); ?>;
  


</script> 
<script src="js/map.js"></script>
  </head> 



<body > 
 <?php include('includes/left_menu.html'); ?>
  <div class="wrappermiddle">
  <div style="margin-top:45px"><img src="images/adventurePoints.png">&nbsp;Current Track Points&nbsp;&nbsp;&nbsp;<img src="images/generalPoints.png">&nbsp;Information Points&nbsp;&nbsp;<img src="images/learnPoints.png">&nbsp;Learn As You Go Points&nbsp;&nbsp;<img src="images/notincurrenttrackPoints.png">&nbsp;Not Current Track Points</div>
    <div class="middle" id="main-content">
         <!-- you can use tables or divs for the overall layout --> 
     <div style="width:100%; height:700px;border: 1px solid black;margin-right:10%">
             <div id="map_canvas" style="width: 33%; height: 100%;float:left;border-right: 1px solid black;"></div> 
            <div id="side_bar" style="width:33%; height:100%; float:left; overflow-y:auto; border-right: 1px solid black;"></div> 
            <div id="right_bar" style="width:33%; height:100%; overflow-y:auto; "></div> 
      </div>
      <br>
      <div style="margin:0 auto; width:100%;">
      <b>Point Filter: </b><input type = "text" id="filter" placeholder="Enter Point ID"> &nbsp;&nbsp;&nbsp;<input type="button" value="GO" onclick="filterPoints()">
      </div>
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
<input type="hidden" name="locat_id" value="hidden" id="locat-id">
   
  </body> 
</html> 

  <script type="text/javascript">
  $(document).ready(function(){
    initialize();
  });


</script>

<?php include('includes/footer.html') ?>
