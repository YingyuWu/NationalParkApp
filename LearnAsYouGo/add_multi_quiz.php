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
    <h1>Multi Choice Questions</h1>
        <form action="process_add_multi_quiz.php" method="post" id="form">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="wrong_answer">Options</label>
                <input type="text" class="form-control" id="options" name="options" placeholder="Enter as many as options you want, separate them by ;">
            </div>
            <div class="form-group">
                <label for="correct_answer">Correct answer (id in options)</label>
                <input type="text" class="form-control" id="correct_answer" name="correct_answer" placeholder="Enter as many correct answer id as you want, separate them by ;">
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
            <input type="hidden" name="locatid" id="hidden" value="<?=$locatid ?>">
            <input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
            <input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">
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
            <button type="button"  onclick="submitForm()" class="btn btn-primary btn-large" value="submit" >+ Add Information</button>

        </form>
    </div>
     </div>

<?php include('includes/footer.html'); ?>
<script type="text/javascript">
	function submitForm(){
		var question = document.getElementById("question").value;
		var response = document.getElementById("response").value;
		var response_wrong = document.getElementById("response_wrong").value;
		var options = document.getElementById("options").value;
		var correct = document.getElementById("correct_answer").value;
		var self = this;
		if(question == '' || question == undefined || question.trim() == ''){
			alert("Question is empty");
		}else if(response == '' || response == undefined || response.trim() == ''){
			alert("Response is empty");
		}else if(response_wrong == '' || response_wrong == undefined|| response_wrong.trim() == ''){
			alert("Response for wrong answer is empty");
		}else if(options == '' || options == undefined|| options.trim() == ''){
			alert("Options are empty");
		}else if(correct == '' || correct == undefined|| correct.trim() == ''){
			alert("Correct answer is empty");
		}else{
			self.form.submit();
		}
	}
</script>