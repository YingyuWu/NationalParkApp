<?php
include('includes/header.html');
$locatid = $_GET['locatID'];
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
?>
<?php include('includes/left_menu.html'); ?>
    <div class="wrappermiddle">
        <div class="middle" id="main-content">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <h1>Add fill in blank questions</h1>
                        <form action="process_fill_quizAdd.php" method="post" id="form">
                            <div class="form-group" style="padding-top:20px;">
                                <label for="questionbeforefill">Question</label>
                                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
                            </div>
                            
                            <div class="form-group">
                                <label for="questionafterfill">Short Response</label>
                                <input type="text" class="form-control" id="answer-short" name="answer-short" placeholder="Enter your short answer here">
                            </div>
                            <div class="form-group">
                                <label for="questionafterfill">Long Response</label>
                                <input type="text" class="form-control" id="answer-long" name="answer-long" placeholder="Enter your long answer here">
                            </div>
                            <div class="form-group">
                                <label for="correct_answer">Link(Optional)</label>
                                <input type="text" class="form-control" id="link" name="link" placeholder="Enter url here">
                            </div>
                            <div class="form-group">
                                <label for="correct_answer">Image(Optional)</label>
                                <input type="text" class="form-control" id="image-url1" name="image-url1" placeholder="Enter image url here">
                            </div>
                            <div class="form-group">
                            <label for="correct_answer">Point ID(Optional)</label>
                            <input type="text" class="form-control" id="locat-id" name="locat_id" placeholder="Enter point id here">
                            </div>
                            <input type="hidden" name="locatid" id="hidden" value="<?=$locatid ?>">
                            <input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
                            <input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">
                            <input type="hidden" name="track_type" id="track-type" value="<?=$track_type ?>">
                            <button type="button"  onclick="submitForm()" class="btn btn-primary btn-large" value="submit" >+ Add Information</button>

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
    var answershort = document.getElementById("answer-short").value;
    var answerlong = document.getElementById("answer-long").value;
    var self = this;
    if(question == '' || question == undefined|| question.trim() == ''){
        alert("Question is empty");
    }else if(answershort == '' || answershort == undefined|| answershort.trim() == ''){
        alert("Response short is empty");
    }else if(answerlong == '' || answerlong == undefined|| answerlong.trim() == ''){
        alert("Response long is empty");
    }else{
        self.form.submit();
    }
}
</script>
    <?php include('includes/footer.html') ?>