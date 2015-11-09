var learnPointsIcon = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FD2f1D",
    new google.maps.Size(31, 44));
var adventurePointsIcon = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|2ECCFA",
    new google.maps.Size(21, 34));
var generalPointsIcon = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FAAC58",
    new google.maps.Size(21, 34));


function initialize() {
  // create the map
  document.getElementById("user-id").value = user_id;
  document.getElementById("role-id").value = role_id;
  document.getElementById("header-user-id").value = user_id;
  document.getElementById("header-role-id").value = role_id;
  var question = "";


  var myOptions = {
    zoom: 11,
    center: new google.maps.LatLng(lats[0],lnts[0]),
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map_canvas"),
                                myOptions);
 
  

  // Add markers to the map
  // Set up three markers with info windows 
  // add the points 

 // var question1 = document.getElementById("div1").style.display;

 //var question = '<h3> Waldo Semon Woods </h3>'+ 
 //'<p>is a Hiking spot in Peninsula. Plan your road trip to Waldo Semon Woods in OH with Roadtrippers.</p>'+
 //'<a style= "color: #EA0000;" href = "question.php" > Lets play some questions about Waldo Semon Woods, click me</a>';

 /* var question = '<p> 1.Text/Image Questions&nbsp;&nbsp;&nbsp;<a name="text" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a name="text" id="question-type" onclick="viewQuestions(this);return false;">Edit Questions</a><br/>'+
  //'<a style= "color: #7B7B7B;" id="question-type" name="image" href = "#" onclick="viewQuestions(this);return false;" > 2.Image Questions</a>&nbsp;&nbsp;&nbsp;<a name="image" onclick="addQuestions(this);return false;">Add New</a><br/>'+
  '2.Fill-in Blank Questions&nbsp;&nbsp;&nbsp;<a name="fill" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a id="question-type" name="fill"  onclick="viewQuestions(this);return false;" >Edit Questions</a><br/>'+
  '3.Single Choice Questions&nbsp;&nbsp;&nbsp;<a name="single" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a id="question-type" name="single"  onclick="viewQuestions(this);return false;" >Edit Questions</a><br/>'+
  '4.Multiple Choice Questions&nbsp;&nbsp;&nbsp;<a name="multi" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp<a id="question-type" name="multi" onclick="viewQuestions(this);return false;" >Edit Questions</a> <br/>'+
  '5.Correct Order Questions&nbsp;&nbsp;&nbsp;<a name="order" onclick="addQuestions(this);return false;"">Add New</a>&nbsp;&nbsp;&nbsp<a id="question-type" name="order" onclick="viewQuestions(this);return false;" >Edit Questions</a> <br/>'+
  '6.Information&nbsp;&nbsp;&nbsp;<a name="fact" onclick="addQuestions(this);return false;"">Add New</a>&nbsp;&nbsp;&nbsp<a id="question-type" name="fact" onclick="viewQuestions(this);return false;" >Edit Questions</a> <br/>'+
  '7.Match Questions&nbsp;&nbsp;&nbsp;<a name="match" onclick="addQuestions(this);return false;"">Add New</a>&nbsp;&nbsp;&nbsp<a id="question-type" name="match" onclick="viewQuestions(this);return false;" >Edit Questions</a> <br/></p>';*/

google.maps.event.addListener(map, 'click', function(event) {
        infowindow.close();
		 //addMarker(event.latLng); //function use to add marker on the map
        });



  for(var i = 0; i < lats.length; i++){
    var point = new google.maps.LatLng(lats[i], lnts[i]);
    var marker = createMarker(point,locat_id[i],title[i],location_type[i])
  }

  // put the assembled side_bar_html contents into the side_bar div
  document.getElementById("side_bar").innerHTML = side_bar_html;
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
function createMarker(latlng, name, title, location_type) {
	var pinImage;
	if(location_type == '1'){//information/ general points
		pinImage = adventurePointsIcon;
	}else if(location_type == '0' ){//adventure check points
		pinImage = generalPointsIcon;
	}else if(location_type == '2' || location_type == '3'){//is learn as you go point
		pinImage = learnPointsIcon;
	}
    //var contentString = html;
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
        if(role_id == '1' || role_id == '2'){//admin or citizen
          if(location_type == '1' || location_type == '0'){//not learn as you go point
            infowindow.setContent("<p><b>Title: "+ title + "</b><br><a name='" + marker.id + "' id='" + location_type + "' onclick='addPointToLearn(this)'><b>Add Me To Learn As You Go!</b></a></p>");
          }else if(location_type == '2' || location_type == '3'){//is learn as you go point
              $.ajax({ url: 'countQuestions.php',
                       data: {locatID: marker.id, locationType: location_type, roleID:role_id},
                       type: 'post',
                       success: function(output) {
                            infowindow.setContent(output);
                        }
                  });
          }
          infowindow.open(map,marker);
        }else{//normal user
            if(location_type == '1' || location_type == '0'){//not learn as you go point
              //do nothing
          }else if(location_type == '2' || location_type == '3'){//is learn as you go point
              $.ajax({ url: 'countQuestions.php',
                       data: {locatID: marker.id, locationType: location_type, roleID:role_id},
                       type: 'post',
                       success: function(output) {
                            infowindow.setContent(output);
                        }
                  });
              infowindow.open(map,marker);
          }

        }
		
		
		
        //contentString = html;
        //contentString = contentString;
        //infowindow.setContent("<p>Location ID:" + marker.id + "</p>"+contentString); 
                
        //side_bar_html = "<p> Lat: " + marker.position.G + " Lnt: " + marker.position.K + "</p> <br>";
        });
		/*google.maps.event.addListener(marker, 'dragend', function (event) {
			infowindow.setContent("<p>Point ID: " + marker.id + "<br>" + this.getPosition().lat() + " , " + this.getPosition().lng() + "</p><p><h4>Are you sure to move? </h4><a id='" + marker.id + "' onclick='updateLocation(this)'><b >Yes</b></a>&nbsp;&nbsp;&nbsp;<a><b onclick='resetLocation()'>No</b></a></p>"); 
			infowindow.open(map,marker);
		});*/
    // save the info we need to use later for the side_bar
    gmarkers.push(marker);
    // add a line to the side_bar html
    //side_bar_html += '<a style= "color: #3C3C3C; font-weight:bold;" href="javascript:myclick(' + (gmarkers.length-1) + ')">' + name + '<\/a> &nbsp';
    side_bar_html = '<p>&nbsp;&nbsp;&nbsp;Please click a point to begin!</p>'
}

function addMarker(latlng) {
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
		draggable:true,
        zIndex: Math.round(latlng.lat()*-100000)<<5,
		title:"Drag Me!"
        });
		infowindow.setContent("<p>" + latlng.lat() + " , " + latlng.lng() + "</p><p><a href='add_marker.php?userID="+user_id+"&roleID="+role_id+"&lng=" + latlng.lng() + "&lat=" + latlng.lat() + "'><b>Add Me To The Map!</b></a></p>"); 
        infowindow.open(map,marker); 
		google.maps.event.addListener(marker, 'click', function(event) {
        infowindow.setContent("<p>" + this.getPosition().lat() + " , " + this.getPosition().lng() + "</p><p><a href='add_marker.php?userID="+user_id+"&roleID="+role_id+"&lng=" +  this.getPosition().lng() + "&lat=" + this.getPosition().lat() + "'><b'>Add Me To The Map!</b></a></p>"); 
        infowindow.open(map,marker);        
        //side_bar_html = "<p> Lat: " + marker.position.G + " Lnt: " + marker.position.K + "</p> <br>";
        });
		google.maps.event.addListener(marker, 'dragend', function (event) {
			infowindow.setContent("<p>" + this.getPosition().lat() + " , " + this.getPosition().lng() + "</p><p><a href='add_marker.php?userID="+user_id+"&roleID="+role_id+"&lng=" +  this.getPosition().lng() + "&lat=" + this.getPosition().lat() + "'><b>Add Me To The Map!</b></a></p>"); 
			infowindow.open(map,marker);
		});
    gmarkers.push(marker);
}
function resetLocation(){
	initialize();
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
  $.ajax({ url: 'process_show_description.php',
               data: {check:'review',locatID: filterpoint},
               type: 'post',
               success: function(output) {
                    $('#side_bar').html(output);
                }
          });
filterClick(filterpoint);
}
function viewDescription(locatid){
  $.ajax({ url: 'process_show_description.php',
               data: {check:'review',locatID: locatid},
               type: 'post',
               success: function(output) {
                    $('#side_bar').html(output);
                }
          });
}
function viewQuestions(ele){
  var locatid = document.getElementById("locat-id").value;
  var roleid = document.getElementById("role-id").value;
  var userid = document.getElementById("user-id").value;
  if(locatid == '' || locatid == undefined){
    alert.log("location id error");
  }
  $.ajax({ url: 'process_show_questions.php',
               data: {param: ele.name, check:'review', locatID: locatid, roleID:roleid , userID: userid},
               type: 'post',
               success: function(output) {
                            $('#side_bar').html(output);
                            $("input[type='radio']").click(function(){
                    $.ajax({ url: 'process_show_questions.php',
                         data: {questionid: this.id, check: 'update',param:this.className, value: this.value, locatID: locatid, roleID:roleid, userID: userid},
                         type: 'post',
                         success: function(output) {
                                      $('#side_bar').html(output);
                                      
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
  if(locatid == '' || locatid == undefined){
    alert.log("location id error");
  }
  var url;
  if(ele.name == 'text'){
    url = "add_Text_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid;
  }else if(ele.name == 'fill'){
    url = "add_fill_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid;
  }else if(ele.name == 'order'){
    url = "add_Order_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid;
  }else if(ele.name == 'single'){
    url = "add_single_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid;
  }else if(ele.name == 'multi'){
    url = "add_multi_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid;
  }else if(ele.name == 'fact'){
  	url = "add_fact_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid;
  }else if(ele.name == 'match'){
  	url = "add_match_quiz.php?locatID=" + locatid + "&userID=" + userid + "&roleID=" + roleid;
  }
  if(url == undefined || url == ""){
    return;
  }
  window.location = url;
}

function addPointToLearn(point){
	var roleid = document.getElementById("role-id").value;
	var userid = document.getElementById("user-id").value;
	$.ajax({ url: 'update_location_in_learn.php',
               data: {locatID: point.name, locationType: point.id, option:'add'},
               type: 'post',
               success: function(output) {
					alert("Insert Successfully");
                    window.location = "map.php?userID=" + userid + "&roleID=" + roleid;
                }
          });
}
function removePointToLearn(point){
	var roleid = document.getElementById("role-id").value;
	var userid = document.getElementById("user-id").value;
	$.ajax({ url: 'update_location_in_learn.php',
               data: {locatID: point.name, locationType: point.id, option:'remove'},
               type: 'post',
               success: function(output) {
					alert("Remove Successfully");
                    window.location = "map.php?userID=" + userid + "&roleID=" + roleid;
                }
          });
}

