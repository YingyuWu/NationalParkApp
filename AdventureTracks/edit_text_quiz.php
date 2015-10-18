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
if($type == 'text'){
    $query = "SELECT * FROM `questions` WHERE questionid = '".$questionid."'";
    $result = $dbc->query($query);
    if(!$result){
        echo "No Record Found!";
        exit();
    }
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $question = $row['question'];
            $correct_answer = $row['answer'];
            $input = $row['user_input'];
            $link = $row['link'];
            $url = $row['image_url1'];
            $available = $row['available'];
            $input = $row['user_input'];
            $locatid = $row['Locat_ID'];
        }
    }
}else{
    echo "Invalid Type";
    exit();
}
?>

<?php include('includes/left_menu.html'); ?>
    <div class="wrappermiddle">
        <div class="middle" id="main-content">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <h1>Edit/Delete Text/Image Questions</h1>
                <form action="process_edit_text_quiz.php" method="post" id="form">
                    <div class="form-group" style="padding-top:20px;">
                        <label for="question"> Question</label>
                        <input type="text" class="form-control" id="question" name="question" value="<?= $question ?>">
                    </div>
                    <div class="form-group">
                        <label for="correct_answer">Response</label>
                        <input type="text" class="form-control" id="correct_answer" name="correct_answer"  value="<?= $correct_answer ?>">
                    </div>
                    <!--<div class="form-group">
                        <label for="input">Visitor's Answer</label>
                        <input type="text" class="form-control" id="input" name="input"  value="<?= $input ?>">
                    </div>-->
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" name="link"  value="<?= $link ?>">
                    </div>
                    <div class="form-group">
                        <label for="image-url1">Image URL</label>
                        <input type="text" class="form-control" id="image-url1" name="image-url1"  value="<?= $url ?>">
                    </div>
                   
                    <div class="form-group">
                        <label for="type">Availablity (Please enter the 0 or 1)</label>
                        <input type="text" style="width:50px;" class="form-control" id="available" name="type"  value="<?= $available ?>">
                    </div>
                    <div class="form-group">
                        <label for="correct_answer">Point ID(Optional)</label>
                        <input type="text" class="form-control" id="locat-id" name="locat_id" placeholder="Enter point id here">
                    </div>
                    <button type="button" onclick="submitForm()" class="btn btn-primary btn-large" value="submit"  ><?= $modified ?></button>
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
    var correct = document.getElementById("correct_answer").value;
    var available = document.getElementById("available").value;
    var self = this;
    if(question == '' || question == undefined || question.trim() == ''){
        alert("Question is empty");
    }else if(available == '' || available == undefined|| available.trim() == ''){
        alert("Availability is empty, must be 0 or 1");
    }else if(correct == '' || correct == undefined|| correct.trim() == ''){
        alert("Response is empty");
    }else{
        self.form.submit();
    }
}
</script>
    <?php include('includes/footer.html') ?>