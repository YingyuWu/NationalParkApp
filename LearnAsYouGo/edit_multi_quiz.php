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
if($type == 'multi'){
    $query = "SELECT * FROM `multiQuestions` WHERE questionid = '".$questionid."'";
    $result = $dbc->query($query);
    if(!$result){
        echo "No Record Found!";
        exit();
    }
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $question = $row['question'];
            $correct_answer = $row['correct_answer'];
            $options = $row['options'];
            $response = $row['response'];
            $link = $row['link'];
            $url = $row['image_url1'];
            $available = $row['available'];
            $input = $row['user_input'];
            $response_wrong = $row['response_wrong'];
        }
    }
}else{
    echo "Invalid Type";
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
    <h1>Edit Multi Choice Questions</h1>
        <form action="process_edit_multi_quiz.php" method="post" id="form">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" value="<?= $question ?>">
            </div>
            <div class="form-group">
                <label for="wrong_answer">Options</label>
                <input type="text" class="form-control" id="options" name="options" value="<?= $options ?>">
            </div>
            <div class="form-group">
                <label for="correct_answer">Correct answers (id in options)</label>
                <input type="text" class="form-control" id="correct_answer" name="correct_answer" value="<?= $correct_answer ?>">
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
            <button type="button" onclick="submitForm()" class="btn btn-primary btn-large" value="submit"><?= $modified ?></button>
            <input type="hidden" name="hidden" id="hidden" value="<?= $edit ?>">
            <input type="hidden" id="questionid" name="questionid"value="<?= $questionid ?>">
            <input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
            <input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">

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
    var available = document.getElementById("available").value;
    var self = this;
    if(question == '' || question == undefined || question.trim() == ''){
        alert("Question is empty");
    }else if(available == '' || available == undefined|| available.trim() == ''){
        alert("Availability is empty, must be 0 or 1");
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