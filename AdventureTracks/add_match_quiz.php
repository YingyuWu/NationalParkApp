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
                    <h1>Add Match Questions</h1>
                        <form action="process_add_match_quiz.php" method="post">
                            <div class="form-group" style="padding-top:20px;">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
                            </div>
                            <div class="form-group">
                                <label for="wrong_answer">Left Title (title for the left options)</label>
                                <input type="text" class="form-control" id="left_title" name="left_title" placeholder="Enter the title for the left options">
                            </div>
                            <div class="form-group">
                                <label for="wrong_answer">Left Options</label>
                                <input type="text" class="form-control" id="left_options" name="left_options" placeholder="Enter as many as left options you want, separate them by ;">
                            </div>
                            <div class="form-group">
                                <label for="wrong_answer">Right Title</label>
                                <input type="text" class="form-control" id="right_title" name="right_title" placeholder="Enter the title for the right options">
                            </div>
                            <div class="form-group">
                                <label for="correct_answer">Right Options (right options should put in the order that match the left options)</label>
                                <input type="text" class="form-control" id="right_options" name="right_options" placeholder="Enter as many right options as you want, separate them by ;">
                            </div>
                            <div class="form-group">
                                <label for="correct_answer">Response For Correct Answer</label>
                                <input type="text" class="form-control" id="response" name="response" placeholder="Enter response for correct answer here">
                            </div>
                            <div class="form-group">
                                <label for="correct_answer">Response For Wrong Answer</label>
                                <input type="text" class="form-control" id="response_wrong" name="response_wrong" placeholder="Enter response for wrong answer here">
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
                            <!--
                            <div class="form-group">
                                <label class="sr-only" for="wrong_answer2">Wrong Answers 2</label>
                                <input type="text" class="form-control" id="wrong_answer2" name="wrong_answer2" placeholder="Wrong answer 2">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="wrong_answer3">Wrong Answers 3</label>
                                <input type="text" class="form-control" id="wrong_answer3" name="wrong_answer3" placeholder="Wrong answer 3">
                            </div>
                            -->
                            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>

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
</script>
<?php include('includes/footer.html'); ?>