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
        <h1>Add Information</h1>
        <form action="process_add_fact_quiz.php" method="post" id="form">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Information</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
             <div class="form-group">
                <label for="correct_answer">Link(Optional)</label>
                <input type="text" class="form-control" id="link" name="link" placeholder="Enter url here">
            </div>
            <!--<div class="form-group">
                <label for="correct_answer">Audio(Under Construction)</label>
                <input type="text" class="form-control" id="audio" name="audio" placeholder="Enter audio here">
            </div>
            <div class="form-group">
                <label for="correct_answer">Gps(Under Construction)</label>
                <input type="text" class="form-control" id="gps" name="gps" placeholder="Enter gps here">
            </div>-->
            <div class="form-group">
                <label for="correct_answer">Image(Optional)</label>
                <input type="text" class="form-control" id="image-url1" name="image-url1" placeholder="Enter image url here">
            </div>
            <input type="hidden" name="locatid" id="hidden" value="<?=$locatid ?>">
            <input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
            <input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">
            <!--
            <div class="form-group">
                <label for="wrong_answer1">Wrong Answers</label>
                <input type="text" class="form-control" id="wrong_answer1" name="wrong_answer1" placeholder="Wrong answer 1">
            </div>
            <div class="form-group">
                <label class="sr-only" for="wrong_answer2">Wrong Answers 2</label>
                <input type="text" class="form-control" id="wrong_answer2" name="wrong_answer2" placeholder="Wrong answer 2">
            </div>
            <div class="form-group">
                <label class="sr-only" for="wrong_answer3">Wrong Answers 3</label>
                <input type="text" class="form-control" id="wrong_answer3" name="wrong_answer3" placeholder="Wrong answer 3">
            </div>
            -->
            <button type="button" onclick="submitForm()" class="btn btn-primary btn-large" value="submit" >+ Add Information</button>

        </form>
    </div>
     </div>

    <?php include('includes/footer.html') ?>
	<script type="text/javascript">
	function submitForm(){
			var question = document.getElementById("question").value;
			var self = this;
			if(question == '' || question == undefined|| question.trim() == ''){
				alert("Question is empty");
			}else{
				self.form.submit();
			}
		}

</script>