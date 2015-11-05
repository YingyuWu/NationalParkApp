var correctPointsIcon = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FD2f1D",
    new google.maps.Size(31, 44));
var incorrectPointsIcon = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|848484",
    new google.maps.Size(21, 34));

function initialize() {
  // create the map
  document.getElementById("track-name").innerHTML = track_name;
  document.getElementById("user-id").value = user_id;
  document.getElementById("role-id").value = role_id;
  document.getElementById("track-type").value = track_type;
  document.getElementById("header-user-id").value = user_id;
  document.getElementById("header-role-id").value = role_id;
var question="";



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
    zoom: 12,
    center: new google.maps.LatLng(lats[0],lnts[0]),
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    }
  }
  
  map = new google.maps.Map(document.getElementById("map_canvas"),
                                myOptions);
 
  google.maps.event.addListener(map, 'click', function(event) {
        infowindow.close();
		//addMarker(event.latLng);
        });

  // Add markers to the map
  // Set up three markers with info windows 
  // add the points 

 // var question1 = document.getElementById("div1").style.display;

 //var question = '<h3> Waldo Semon Woods </h3>'+ 
 //'<p>is a Hiking spot in Peninsula. Plan your road trip to Waldo Semon Woods in OH with Roadtrippers.</p>'+
 //'<a style= "color: #EA0000;" href = "question.php" > Lets play some questions about Waldo Semon Woods, click me</a>';

 /* var question = '<a style= "color: #000000;" id="question-type" name="text" href = "#" onclick="viewQuestionsByPointID(this);return false;"> 1.Text/Image Questions</a>&nbsp;&nbsp;&nbsp;<a name="text" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  //'<a style= "color: #7B7B7B;" id="question-type" name="image" href = "#" onclick="viewQuestions(this);return false;" > 2.Image Questions</a>&nbsp;&nbsp;&nbsp;<a name="image" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  '<a style= "color: #000000;" id="question-type" name="fill" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 2.Fill-in Blank Questions</a>&nbsp;&nbsp;&nbsp;<a name="fill" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  '<a style= "color: #7B7B7B;" id="question-type" name="single" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 3.Single Choice Questions</a>&nbsp;&nbsp;&nbsp;<a name="single" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  '<a style= "color: #000000;" id="question-type" name="multi" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 4.Multiple Choice Questions</a>&nbsp;&nbsp;&nbsp;<a name="multi" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  '<a style= "color: #7B7B7B;" id="question-type" name="order" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 5.Correct Order Questions</a>&nbsp;&nbsp;&nbsp;<a name="order" onclick="addQuestions(this);return false;"">Add New</a><br/>'+
  '<a style= "color: #7B7B7B;" id="question-type" name="fact" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 6.Information</a>&nbsp;&nbsp;&nbsp;<a name="fact" onclick="addQuestions(this);return false;"">Add New</a><br/>'+
  '<a style= "color: #7B7B7B;" id="question-type" name="match" href = "#" onclick="viewQuestionsByPointID(this);return false;" > 7.Match Questions</a>&nbsp;&nbsp;&nbsp;<a name="match" onclick="addQuestions(this);return false;"">Add New</a><br/>';

*/



  for(var i = 0; i < lats.length; i++){
    var point = new google.maps.LatLng(lats[i], lnts[i]);
    var marker = createMarker(point,locat_id[i],titles[i], tracktypes[i],locationtypes[i])
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
function createMarker(latlng, name, title, tracktype,locationtype) {
  var pinImage;
  
  if(locationtype == '0' || locationtype == '2'){
    pinImage = incorrectPointsIcon;
  }else if(locationtype == '1' || locationtype == '3'){
    var types = tracktype.split(";");//one point can be in multiple tracks
    var index = types.indexOf(track_type);
    if(index == '-1'){//not this track's point
    pinImage = incorrectPointsIcon;
    }else{//is this track's point
      pinImage = correctPointsIcon;
    }
  }
  
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        id:name,
        icon: pinImage,
		//draggable:true,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });

    google.maps.event.addListener(marker, 'click', function() {
        document.getElementById("locat-id").value = marker.id;
        viewDescription(marker.id);
        if(locationtype == '0' || locationtype == '2'){//general or learn as you go points only
          infowindow.setContent("<p><b>Title: "+ title + "</b><br><a name='" + marker.id + "' id='" + locationtype + "' onclick='addPointToTrack(this)'><b>Add Me To This Track!</b></a></p>");
        }else if(locationtype == '1' || locationtype == '3'){
          var types = tracktype.split(";");//one point can be in multiple tracks
          var index = types.indexOf(track_type);
          if(index == '-1'){//not this track's point
            infowindow.setContent("<p><b>Title: "+ title + "</b><br><a name='" + marker.id + "' id='" + locationtype + "' onclick='addPointToTrack(this)'><b>Add Me To This Track!</b></a></p>");
          }else{//is this track's point
              $.ajax({ url: 'countQuestions.php',
                 data: {locatID: marker.id, userID:user_id, roleID:role_id, trackType:track_type, locationType: locationtype},
                 type: 'post',
                 success: function(output) {
                      infowindow.setContent(output);
                  }
            });
          }
        }
		
        infowindow.open(map,marker);        
        });
		//google.maps.event.addListener(marker, 'dragend', function (event) {
			//infowindow.setContent("<p>Point ID: " + marker.id + "<br>" + this.getPosition().lat() + " , " + this.getPosition().lng() + "</p><p><h4>Are you sure to move? </h4><a id='" + marker.id + "' onclick='updateLocation(this)'><b >Yes</b></a>&nbsp;&nbsp;&nbsp;<a><b onclick='resetLocation()'>No</b></a></p>"); 
			//infowindow.open(map,marker);
		//});
    gmarkers.push(marker);
  
    var side_content = "<h2 style='padding-left:10px;'>List Of Points</h2>";
    titles.forEach(function(des,i){
        side_content += "&nbsp;&nbsp;<a name='"+ locat_id[i] +"' onclick='viewPointDescription(this)'><b>"  + des + "</b></a><br>"; 
    })
    side_bar_html = side_content;
    right_bar_html = "<p>&nbsp;&nbsp;Click on points to view description!</p>";

}
 function addMarker(latlng) {
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
		    draggable:true,
        zIndex: Math.round(latlng.lat()*-100000)<<5,
		title:"Drag Me!"
        });
		var track_type = document.getElementById("track-type").value;
		infowindow.setContent("<p>" + latlng.lat() + " , " + latlng.lng() + "</p><p><a href='add_marker.php?trackType=" + track_type + "&userID="+user_id+"&roleID="+role_id+"&lng=" + latlng.lng() + "&lat=" + latlng.lat() + "'><b>Add Me To The Map!</b></a></p>"); 
        infowindow.open(map,marker); 
		google.maps.event.addListener(marker, 'click', function(event) {
        infowindow.setContent("<p>" + this.getPosition().lat() + " , " + this.getPosition().lng() + "</p><p><a href='add_marker.php?trackType=" + track_type + "&userID="+user_id+"&roleID="+role_id+"&lng=" +  this.getPosition().lng() + "&lat=" + this.getPosition().lat() + "'><b'>Add Me To The Map!</b></a></p>"); 
        infowindow.open(map,marker);        
        //side_bar_html = "<p> Lat: " + marker.position.G + " Lnt: " + marker.position.K + "</p> <br>";
        });
		google.maps.event.addListener(marker, 'dragend', function (event) {
			infowindow.setContent("<p>" + this.getPosition().lat() + " , " + this.getPosition().lng() + "</p><p><a href='add_marker.php?trackType=" + track_type + "&userID="+user_id+"&roleID="+role_id+"&lng=" +  this.getPosition().lng() + "&lat=" + this.getPosition().lat() + "'><b>Add Me To The Map!</b></a></p>"); 
			infowindow.open(map,marker);
		});
    gmarkers.push(marker);
}
function resetLocation(){
	initialize();
}
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
function addPointToTrack(point){
  var roleid = document.getElementById("role-id").value;
  var userid = document.getElementById("user-id").value;
  var track_type = document.getElementById("track-type").value;
  $.ajax({ url: 'update_location_in_track.php',
               data: {locatID: point.name, locationType: point.id, option:'add', trackType:track_type},
               type: 'post',
               success: function(output) {
                console.log(output);
                    alert("Insert Successfully");
                    window.location = "map.php?userID=" + userid + "&roleID=" + roleid + "&trackType=" + track_type;
                }
          });
}
function removePointToTrack(point){
  var roleid = document.getElementById("role-id").value;
  var userid = document.getElementById("user-id").value;
  var track_type = document.getElementById("track-type").value;
  $.ajax({ url: 'update_location_in_track.php',
               data: {locatID: point.name, locationType: point.id, option:'remove',trackType:track_type},
               type: 'post',
               success: function(output) {
                console.log(output);
                    alert("Remove Successfully");
                    window.location = "map.php?userID=" + userid + "&roleID=" + roleid + "&trackType=" + track_type;
                }
          });
}