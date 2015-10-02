<?php
include('includes/header.html');
$locatid = $_GET['locatID'];
if($locatid == ''){
    echo "Location ID is invalid";
    exit();
}
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
?>
<script type="text/javascript">
var user_id = <?php echo json_encode($userid); ?>;
var role_id = <?php echo json_encode($roleid); ?>;
document.getElementById("header-user-id").value = user_id;
document.getElementById("header-role-id").value = role_id;
</script>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1>Add fill in blank questions</h1>
        <form action="process_fill_quizAdd.php" method="post">
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
            <input type="hidden" name="locatid" id="hidden" value="<?=$locatid ?>">
            <input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
            <input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>

        </form>
    </div>
     </div>

    <?php include('includes/footer.html') ?>