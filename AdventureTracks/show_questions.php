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
$question_type= $_GET['Type'];
if($question_type == ''){
  $question_type = "text";
}
?>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/show_question.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body onload="init()">
<div class="main"> 
	<div class="left">
	     <ul>
       <li><a onclick="viewPoints(this)">Points</a></li>
       <li><a name="text" onclick="viewQuestions(this)">Text/Image Questions</a></li>
       <li><a name="fill" onclick="viewQuestions(this)">Fill In Questions</a></li>
       <li><a name="single" onclick="viewQuestions(this)">Single Choice Questions</a></li>
       <li><a name="multi" onclick="viewQuestions(this)">Multiple Choice Questions</a></li>
       <li><a name="match" onclick="viewQuestions(this)">Match Questions</a></li>
       <li><a name="order" onclick="viewQuestions(this)">Correct Order Questions</a></li>
       <li><a name="fact" onclick="viewQuestions(this)">Information</a></li>
       </ul>
	</div>
	<div class="wrappermiddle">
		<div style="padding-top:10px; border:1px solid black" class="middle" id="main-content">

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
<script type="text/javascript">


	function viewQuestions(questiontype){
	  var roleid = document.getElementById("role-id").value;
	  var userid = document.getElementById("user-id").value;
	  var track_type = document.getElementById("track-type").value;
	  if(questiontype != "text" && questiontype != "fill" && questiontype != "single" && questiontype != "multi" && questiontype != "order"&&questiontype != "match"&&questiontype != "fact"){
	  	questiontype = questiontype.name;
	  }
  		$.ajax({ url: 'process_show_questions.php',
               data: {param: questiontype, check:'all', roleID:roleid , userID: userid, trackType: track_type},
               type: 'post',
               success: function(output) {
                            $('#main-content').html(output);
                            $("input[type='radio']").click(function(){
                    $.ajax({ url: 'process_show_questions.php',
                         data: {questionid: this.id, check: 'update',param:this.className, value: this.value, roleID:roleid, userID: userid, trackType: track_type, extra:'all'},
                         type: 'post',
                         success: function(output) {
                                      $('#main-content').html(output);
                                      
                          }
                    });
                  });
                        }
          });
}
function viewPoints(ele){
  var userid = document.getElementById("user-id").value;
  var roleid = document.getElementById("role-id").value;
  var track_type = document.getElementById("track-type").value;
  var url = "map.php?userID=" + userid + "&roleID=" + roleid + "&trackType=" + track_type;
  window.location = url;
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

function init(){
  var user_id = <?php echo json_encode($userid); ?>;
  var role_id = <?php echo json_encode($roleid); ?>;
  var track_type = <?php echo json_encode($track_type); ?>;
  var question_type = <?php echo json_encode($question_type); ?>;
  document.getElementById("user-id").value = user_id;
  document.getElementById("role-id").value = role_id;
  document.getElementById("track-type").value = track_type;
  document.getElementById("header-user-id").value = user_id;
  document.getElementById("header-role-id").value = role_id;
  viewQuestions(question_type);
}
</script>


    <?php include('includes/footer.html') ?>