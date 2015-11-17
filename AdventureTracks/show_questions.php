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
 echo "Track Type is invalid";
  exit();
}
require_once('includes/db_conn.php');
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
$dbc->close();
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/show_question.css">
<link rel="stylesheet" type="text/css" href="css/listbtn.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="navigation">
	<ul style="float:left">
		<li><a href="javascript:void(0);" id="text" class="selected">Text/Image Question</a></li>
		<li><a href="javascript:void(0);" id="fill">Fill-in Blank Question</a></li>
		<li><a href="javascript:void(0);" id="single">Single Choice Question</a></li>
		<li><a href="javascript:void(0);" id="multi">Multi Choice Question</a></li>
		<li><a href="javascript:void(0);" id="order">Correct Order Question</a></li>
		<li><a href="javascript:void(0);" id="match">Match Question</a></li>
		<li><a href="javascript:void(0);" id="fact">Information</a></li>
	</ul>
	<input id="questionButton" name="text" class="listbtn" style="float:right;font-size: 15px; padding: 5px 5px 5px 5px;display:none" type="button" value="Add Text/Image Question" onclick="addQuestions(this)">
	<div class="clear"></div>
</div>
<div id="content">
	<p id="content_changer"></p>
</div>
<input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
<input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">
<input type="hidden" name="track_type" id="track-type" value="<?=$track_type ?>">
</body>
<script type="text/javascript">
var user_id = <?php echo json_encode($userid); ?>;
var role_id = <?php echo json_encode($roleid); ?>;
var track_type = <?php echo json_encode($track_type); ?>;
var track_name = <?php echo json_encode($track_name); ?>;
document.getElementById("menu_questions").style.backgroundColor = "#6F74B9";
document.getElementById("track-name").innerHTML = track_name;
document.getElementById("header-user-id").value = user_id;
document.getElementById("header-role-id").value = role_id; 
if(role_id != '0'){
	document.getElementById("questionButton").style.display = "inline";
}

function viewQuestions(ele){
  var type = ele.name;
  var url = "show_questions.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
  window.location = url;
}

function viewPoints(ele){
  var url = "map.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
  window.location = url;
}
function switchTracks(ele){
    window.location = "list.php?userID=" + user_id + "&roleID=" + role_id;
}
function viewIntroduction(ele){
    window.location = "main.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
}
function addQuestions(ele){
  var url;
  if(ele.name == 'text'){
    url = "add_Text_quiz.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
  }else if(ele.name == 'fill'){
    url = "add_fill_quiz.php?userID=" + user_id + "&roleID=" + role_id+ "&trackType=" + track_type;
  }else if(ele.name == 'order'){
    url = "add_Order_quiz.php?userID=" + user_id + "&roleID=" + role_id+ "&trackType=" + track_type;
  }else if(ele.name == 'single'){
    url = "add_single_quiz.php?userID=" + user_id + "&roleID=" + role_id+ "&trackType=" + track_type;
  }else if(ele.name == 'multi'){
    url = "add_multi_quiz.php?userID=" + user_id + "&roleID=" + role_id+ "&trackType=" + track_type;
  }else if(ele.name == 'fact'){
    url = "add_fact_quiz.php?userID=" + user_id + "&roleID=" + role_id+ "&trackType=" + track_type;
  }else if(ele.name == 'match'){
    url = "add_match_quiz.php?userID=" + user_id + "&roleID=" + role_id+ "&trackType=" + track_type;
  }
  if(url == undefined || url == ""){
    return;
  }
  window.location = url;
}
  
	$(document).ready(function(){
		//for default 
		$.ajax({ url: 'process_show_questions.php',
			         data: {param: 'text',check:'all',userID:user_id, roleID:role_id,trackType:track_type},
			         type: 'post',
			         success: function(output) {
			                      $('#content_changer').html(output);
			                      $("input[type='radio']").click(function(){
										$.ajax({ url: 'process_show_questions.php',
								         data: {questionid: this.id, check: 'update',param:'text', value: this.value, extra: 'all',userID:user_id, roleID:role_id,trackType:track_type},
								         type: 'post',
								         success: function(output) {
								                      $('#content_changer').html(output);
								                      
								                  }
										});
									});
			                  }
			});
		$('#navigation ul a').click(function(){
			$('#navigation ul a').removeClass('selected');
			$(this).addClass('selected');
			if(this.id=="text"){
				document.getElementById("questionButton").value = "Add Text/Image Question";
				document.getElementById("questionButton").name = this.id;
			}else if(this.id == "fill"){
				document.getElementById("questionButton").value = "Add Fill In Blank Question";
				document.getElementById("questionButton").name = this.id;
			}else if(this.id == "single"){
				document.getElementById("questionButton").value = "Add Single Choice Question";
				document.getElementById("questionButton").name = this.id;
			}else if(this.id == "multi"){
				document.getElementById("questionButton").value = "Add Multi Choice Question";
				document.getElementById("questionButton").name = this.id;
			}else if(this.id == "order"){
				document.getElementById("questionButton").value = "Add Correct Order Question";
				document.getElementById("questionButton").name = this.id;
			}else if(this.id == "match"){
				document.getElementById("questionButton").value = "Add Match Question";
				document.getElementById("questionButton").name = this.id;
			}else if(this.id == "fact"){
				document.getElementById("questionButton").value = "Add Information";
				document.getElementById("questionButton").name = this.id;
			}
			//call php
			$.ajax({ url: 'process_show_questions.php',
			         data: {param: this.id, check:'all',userID:user_id, roleID:role_id,trackType:track_type},
			         type: 'post',
			         success: function(output) {
			                      $('#content_changer').html(output);
			                      $("input[type='radio']").click(function(){
										$.ajax({ url: 'process_show_questions.php',
								         data: {questionid: this.id, check: 'update',param:this.className, value: this.value,extra: 'all',userID:user_id, roleID:role_id,trackType:track_type},
								         type: 'post',
								         success: function(output) {
								                      $('#content_changer').html(output);
								            
								                  }
										});
									});
			                  }
					});
			});
	});


</script>


    <?php include('includes/footer.html') ?>