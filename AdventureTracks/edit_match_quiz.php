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
$type = ($_GET['type']);
$questionid = ($_GET['id']);
$edit = ($_GET['edit']);
if($questionid == ''){
    echo "Invalid questionid";
    exit();
}
if($edit == ''){
    echo "Invalid Edit Type";
    exit();
}
$modified = '';
if($edit == 'edit'){
    $modified = 'Edit Information';
}else if($edit == 'delete'){
    $modified = 'Delete Information';
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
if($type == 'match'){
    $query = "SELECT * FROM `matchQuestions` WHERE questionid = '".$questionid."'";
    $result = $dbc->query($query);
    if(!$result){
        echo "No Result is Found!";
        exit();
    }
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $question = $row['question'];
            $left_title = $row['left_title'];
            $left_options = $row['left_options'];
            $right_options = $row['right_options'];
            $right_title = $row['right_title'];
            $response = $row['response'];
            $link = $row['link'];
            $url = $row['image_url1'];
            $available = $row['available'];
            $response_wrong = $row['response_wrong'];
            $locatid = $row['Locat_ID'];
        }
    }
}else{
    echo "Invalid Type";
    exit();
}
$dbc->close();
?>
<?php include('includes/left_menu.html'); ?>
    <div class="wrappermiddle">
        <div class="middle" id="main-content">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                <h1>Edit/Delete Match Questions</h1>
                    <form action="process_edit_match_quiz.php" method="post" id="form">
                        <div class="form-group" style="padding-top:20px;">
                            <label for="question">Question</label>
                            <input type="text" class="form-control" id="question" name="question" value="<?= $question ?>">
                        </div>
                        <div class="form-group">
                            <label for="wrong_answer">Left Title</label>
                            <input type="text" class="form-control" id="left_title" name="left_title" value="<?= $left_title ?>">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Left Options</label>
                            <input type="text" class="form-control" id="left_options" name="left_options" value="<?= $left_options ?>">
                        </div>
                        <div class="form-group">
                            <label for="wrong_answer">Right Title</label>
                            <input type="text" class="form-control" id="right_title" name="right_title" value="<?= $right_title ?>">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Right Options (right options should put in the order that match the left options)</label>
                            <input type="text" class="form-control" id="right_options" name="right_options" value="<?= $right_options ?>">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Response For Correct Answers</label>
                            <input type="text" class="form-control" id="response" name="response" value="<?= $response ?>">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Response For Wrong Answers</label>
                            <input type="text" class="form-control" id="response_wrong" name="response_wrong" value="<?= $response_wrong ?>">
                        </div>
                        <!--<div class="form-group">
                            <label for="input">Visitor's Answer</label>
                            <input type="text" class="form-control" id="user_input" name="user_input"  value="<?= $input ?>">
                        </div>-->
                        <div class="form-group">
                            <label for="correct_answer">Link(Optional)</label>
                            <input type="text" class="form-control" id="link" name="link" value="<?= $url ?>">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Image(Optional)</label>
                            <input type="text" class="form-control" id="image-url1" name="image-url1" value="<?= $image ?>">
                        </div>
                        <div class="form-group">
                            <label for="type">Availablity (Please enter the 0 or 1)</label>
                            <input type="text" style="width:50px;" class="form-control" id="available" name="type"  value="<?= $available ?>">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Point ID(Optional)</label>
                            <input type="text" class="form-control" id="locat-id" name="locat_id" placeholder="Enter point id here">
                        </div>
                        <button type="button" onclick="submitForm()" class="btn btn-primary btn-large" value="submit" ><?= $modified ?></button>
                        <input type="hidden" name="hidden" id="hidden" value="<?= $edit ?>">
                        <input type="hidden" id="questionid" name="questionid"value="<?= $questionid ?>">
                        <input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
                        <input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">
                        <input type="hidden" name="track_type" id="track-type" value="<?=$track_type ?>">

                    </form>
                </div>
                 </div>
</div>
</div>


<script type="text/javascript">
var user_id = <?php echo json_encode($userid); ?>;
var role_id = <?php echo json_encode($roleid); ?>;
var track_type = <?php echo json_encode($track_type); ?>;
var locat_id = <?php echo json_encode($locatid); ?>;
var track_name = <?php echo json_encode($track_name); ?>;
document.getElementById("track-name").innerHTML = track_name;
document.getElementById("header-user-id").value = user_id;
document.getElementById("header-role-id").value = role_id;
if(locat_id != '' && locat_id != undefined && locat_id != '0'){
    document.getElementById("locat-id").value = locat_id;
}   

function viewQuestions(ele){
  var type = ele.name;
  var url = "show_questions.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type + "&Type=" + type;
  window.location = url;
}

function viewPoints(ele){
  var url = "map.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
  window.location = url;
}
function submitForm(){
    var question = document.getElementById("question").value;
    var response = document.getElementById("response").value;
    var response_wrong = document.getElementById("response_wrong").value;
    var left = document.getElementById("left_options").value;
    var right = document.getElementById("right_options").value;
    var available = document.getElementById("available").value;
    var self = this;
    if(question == '' || question == undefined|| question.trim() == ''){
        alert("Question is empty");
    }else if(available == '' || available == undefined|| available.trim() == ''){
        alert("Availability is empty, must be 0 or 1");
    }else if(response == '' || response == undefined|| response.trim() == ''){
        alert("Response is empty");
    }else if(response_wrong == '' || response_wrong == undefined|| response_wrong.trim() == ''){
        alert("response for wrong answer is empty");
    }else if(left == '' || left == undefined|| left.trim() == ''){
        alert("Left options are empty");
    }else if(right == '' || right == undefined|| right.trim() == ''){
        alert("Right options are empty");
    }else{
        self.form.submit();
    }
}
function switchTracks(ele){
    window.location = "list.php?userID=" + user_id + "&roleID=" + role_id;
}
function viewIntroduction(ele){
    window.location = "main.php?userID=" + user_id + "&roleID=" + role_id + "&trackType=" + track_type;
}
</script>
<?php include('includes/footer.html'); ?>