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
$query = "SELECT * FROM `Location` INNER JOIN `AdventureTracksPoints` WHERE `AdventureTracksPoints`.Locat_ID=`Location`.ID AND `Location`.User_ID = '".$userid."' AND `AdventureTracksPoints`.Track_Type = '".$track_type."' AND `Location`.Pub_Or_Priva = '1' ORDER BY `Location`.ID";
$result = $dbc->query($query);
$count = 0;
$lat = array();
$lnt = array();
$locat_id = array();
$descriptions = array();
$titles = array();
if(!$result){
        echo '<h1>System Error</h1>';
        exit();
}
if($result->num_rows > 0){
        //Fetch rows
        while($row = $result->fetch_assoc()){
            $lat[$count] = $row['Latitude'];
            $lnt[$count] = $row['Longitude'];
            $locat_id[$count] = $row['Locat_ID'];
            $titles[$count] = $row['Title'];
            $descriptions[$count] = $row['Description'];
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



function initialize() {
  // create the map
  lats = <?php echo json_encode($lat); ?>;//all the points from database
  lnts = <?php echo json_encode($lnt); ?>;
  titles = <?php echo json_encode($titles); ?>;
  descriptions = <?php echo json_encode($descriptions); ?>;
  locat_id = <?php echo json_encode($locat_id); ?>;
  user_id = <?php echo json_encode($userid); ?>;
  role_id = <?php echo json_encode($roleid); ?>;
  track_type = <?php echo json_encode($track_type); ?>;
  var track_name = <?php echo json_encode($track_name); ?>;
  document.getElementById("track-name").innerHTML = track_name;
  document.getElementById("user-id").value = user_id;
  document.getElementById("role-id").value = role_id;
  document.getElementById("track-type").value = track_type;
  document.getElementById("header-user-id").value = user_id;
  document.getElementById("header-role-id").value = role_id;




  if(lats.length == 0){
    var myOptions = {
    zoom: 17,
    center: new google.maps.LatLng(41.221030,-81.519655),
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    }
  }else{
    var myOptions = {
    zoom: 15,
    center: new google.maps.LatLng(lats[0],lnts[0]),
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    }
  }
  
  map = new google.maps.Map(document.getElementById("map_canvas"),
                                myOptions);
 
  google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
        });

  // Add markers to the map
  // Set up three markers with info windows 
  // add the points 

 // var question1 = document.getElementById("div1").style.display;

 //var question = '<h3> Waldo Semon Woods </h3>'+ 
 //'<p>is a Hiking spot in Peninsula. Plan your road trip to Waldo Semon Woods in OH with Roadtrippers.</p>'+
 //'<a style= "color: #EA0000;" href = "question.php" > Lets play some questions about Waldo Semon Woods, click me</a>';

  var question = '<a style= "color: #000000;" id="question-type" name="text" href = "#" onclick="viewQuestionsByPointID(this);return false;"> 1.Text/Image Questions</a>&nbsp;&nbsp;&nbsp;<a name="text" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  //'<a style= "color: #7B7B7B;" id="question-type" name="image" href = "#" onclick="viewQuestions(this);return false;" > 2.Image Questions</a>&nbsp;&nbsp;&nbsp;<a name="image" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  '<a style= "color: #000000;" id="question-type" name="fill" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 2.Fill-in Blank Questions</a>&nbsp;&nbsp;&nbsp;<a name="fill" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  '<a style= "color: #7B7B7B;" id="question-type" name="single" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 3.Single Choice Questions</a>&nbsp;&nbsp;&nbsp;<a name="single" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  '<a style= "color: #000000;" id="question-type" name="multi" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 4.Multiple Choice Questions</a>&nbsp;&nbsp;&nbsp;<a name="multi" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  '<a style= "color: #7B7B7B;" id="question-type" name="order" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 5.Correct Order Questions</a>&nbsp;&nbsp;&nbsp;<a name="order" onclick="addQuestions(this);return false;"">Add New</a><br/>'+
  '<a style= "color: #7B7B7B;" id="question-type" name="fact" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 6.Information</a>&nbsp;&nbsp;&nbsp;<a name="fact" onclick="addQuestions(this);return false;"">Add New</a><br/>'+
  '<a style= "color: #7B7B7B;" id="question-type" name="match" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 7.Match Questions</a>&nbsp;&nbsp;&nbsp;<a name="match" onclick="addQuestions(this);return false;"">Add New</a><br/>';





  for(var i = 0; i < lats.length; i++){
    var point = new google.maps.LatLng(lats[i], lnts[i]);
    var marker = createMarker(point,locat_id[i],question)
  }

  // put the assembled side_bar_html contents into the side_bar div
  document.getElementById("side_bar").innerHTML = side_bar_html;
  document.getElementById("right_bar").innerHTML = right_bar_html;
}//End of Initialize
 
var infowindow = new google.maps.InfoWindow(
  { 
    size: new google.maps.Size(150,50)
  });
    
// This function picks up the click and opens the corresponding info window
function filterClick(i) {
  var filtermark = gmarkers.filter(function(value){return value.id == i});
  google.maps.event.trigger(filtermark[0], "click");
}

// A function to create the marker and set up the event window function 
function createMarker(latlng, name, html) {
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        id:name,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });

    google.maps.event.addListener(marker, 'click', function() {
        document.getElementById("locat-id").value = marker.id;
        //viewDescription(marker.id);
        contentString = html;
        contentString = contentString;
        infowindow.setContent("<p>Location ID:" + marker.id + "</p>"+contentString); 
        infowindow.open(map,marker);
        viewDescription(marker.id); //show descritption on right_bar       
        });
    // save the info we need to use later for the side_bar
    gmarkers.push(marker);
  
    var side_content = "<h2 style='padding-left:10px;'>List Of Points</h2>";
    titles.forEach(function(des,i){
        side_content += "&nbsp;&nbsp;<img style='width:20px; height:30px' src='images/marker.png'>&nbsp;<a name='"+ locat_id[i] +"' onclick='viewPointDescription(this)'>Point ID: " + locat_id[i] + " " + des + "</a><br>"; 
    })
    side_bar_html = side_content;
    right_bar_html = "<p>&nbsp;&nbsp;Click on points to view description!</p>";

}
 
</script> 

  </head> 



<body > 
 <?php include('includes/left_menu.html'); ?>
  <div class="wrappermiddle">
    <div class="middle" id="main-content">
         <!-- you can use tables or divs for the overall layout --> 
     <div style="width:100%; height:700px;margin:0 auto;border: 1px solid black;">
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
function viewPointDescription(ele){
  var id = ele.name;
  var roleid = document.getElementById("role-id").value;
  var userid = document.getElementById("user-id").value;
  document.getElementById("locat-id").value = id;
  viewDescription(id);
}
function viewPoints(ele){
  var userid = document.getElementById("user-id").value;
  var roleid = document.getElementById("role-id").value;
  var track_type = document.getElementById("track-type").value;
  var url = "map.php?userID=" + userid + "&roleID=" + roleid + "&trackType=" + track_type;
  window.location = url;
}
function filterPoints(ele){
  var filterpoint = document.getElementById("filter").value;
  if(filterpoint.length == 0 || filterpoint == undefined){
    alert("invalid point id");
    return;
  }
  filterpoint = filterpoint.replace(/ /g,"");
  for(var i = 0, len = filterpoint.length; i < len; i++){
    console.log(filterpoint[i]);
    if(filterpoint[i] > '9' || filterpoint[i] < '0'){
      alert("invalid point id");
      return;
    }
  }
  viewDescription(filterpoint);
  filterClick(filterpoint);
}
function viewDescription(locatid){
  var roleid = document.getElementById("role-id").value;
  var userid = document.getElementById("user-id").value;
  var track_type = document.getElementById("track-type").value;
  $.ajax({ url: 'process_show_description.php',
               data: {check:'review',locatID: locatid,roleID:roleid , userID: userid, trackType: track_type},
               type: 'post',
               success: function(output) {
                    $('#right_bar').html(output);
                }
          });
}
function viewQuestions(ele){
  var roleid = document.getElementById("role-id").value;
  var userid = document.getElementById("user-id").value;
  var track_type = document.getElementById("track-type").value;
  var type = ele.name;
  var url = "show_questions.php?userID=" + userid + "&roleID=" + roleid + "&trackType=" + track_type + "&Type=" + type;
  window.location = url;
}
function viewQuestionsByPointID(ele){
  var locatid = document.getElementById("locat-id").value;
  var roleid = document.getElementById("role-id").value;
  var userid = document.getElementById("user-id").value;
  var track_type = document.getElementById("track-type").value;
  if(locatid == '' || locatid == undefined){
    alert.log("location id error");
  }
  $.ajax({ url: 'process_show_questions.php',
               data: {param: ele.name, check:'review', locatID: locatid, roleID:roleid , userID: userid, trackType: track_type},
               type: 'post',
               success: function(output) {
                            $('#right_bar').html(output);
                            $("input[type='radio']").click(function(){
                    $.ajax({ url: 'process_show_questions.php',
                         data: {questionid: this.id, check: 'update',param:this.className, value: this.value, locatID: locatid, roleID:roleid, userID: userid, trackType: track_type},
                         type: 'post',
                         success: function(output) {
                                      $('#right_bar').html(output);
                                      
                          }
                    });
                  });
                        }
          });
}
function addQuestions(ele){
  var locatid = document.getElementById("locat-id").value;
  var userid = document.getElementById("user-id").value;
  var roleid = document.getElementById("role-id").value;
  var track_type = document.getElementById("track-type").value;
  var url;
  if(ele.name == 'text'){
    url = "add_Text_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid + "&trackType=" + track_type;
  }else if(ele.name == 'fill'){
    url = "add_fill_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid+ "&trackType=" + track_type;
  }else if(ele.name == 'order'){
    url = "add_Order_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid+ "&trackType=" + track_type;
  }else if(ele.name == 'single'){
    url = "add_single_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid+ "&trackType=" + track_type;
  }else if(ele.name == 'multi'){
    url = "add_multi_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid+ "&trackType=" + track_type;
  }else if(ele.name == 'fact'){
    url = "add_fact_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid+ "&trackType=" + track_type;
  }else if(ele.name == 'match'){
    url = "add_match_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid+ "&trackType=" + track_type;
  }
  if(url == undefined || url == ""){
    return;
  }
  window.location = url;
}

function switchTracks(ele){
  var user_id = document.getElementById("user-id").value;
  var role_id = document.getElementById("role-id").value;
    window.location = "list.php?userID=" + user_id + "&roleID=" + role_id;
}
function viewIntroduction(ele){
  var user_id = document.getElementById("user-id").value;
  var role_id = document.getElementById("role-id").value;
  var track_type = document.getElementById("track-type").value;
    window.location = "main.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
}
  $(document).ready(function(){
    initialize();
  });


</script>

<?php include('includes/footer.html') ?>
