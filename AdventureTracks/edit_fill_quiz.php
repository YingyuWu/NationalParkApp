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
if($type == 'fill'){
    $query = "SELECT * FROM `FillQuestions` WHERE questionid = '".$questionid."'";
    $result = $dbc->query($query);
    if(!$result){
        echo "No Record Found!";
        exit();
    }
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $question = $row['question'];
            $answer_short = $row['answer_short'];
            $answer_long = $row['answer_long'];
            $link = $row['link'];
            $url = $row['image_url1'];
            $available = $row['available'];
            $input = $row['user_input'];
        }
    }
}else{
    echo "Invalid Type";
    exit();
}
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
var user_id = <?php echo json_encode($userid); ?>;
var role_id = <?php echo json_encode($roleid); ?>;
document.getElementById("header-user-id").value = user_id;
document.getElementById("header-role-id").value = role_id;
</script>
</head>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1>Edit Fill In Questions</h1>
        <form action="process_edit_fill_quiz.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="question"> Question</label>
                <input type="text" class="form-control" id="question" name="question" value="<?= $question ?>">
            </div>
            <div class="form-group">
                <label for="correct_answer">Short Response</label>
                <input type="text" class="form-control" id="answer_short" name="answer_short"  value="<?= $answer_short ?>">
            </div>
            <div class="form-group">
                <label for="correct_answer">Long Response</label>
                <input type="text" class="form-control" id="answer_long" name="answer_long"  value="<?= $answer_long ?>">
            </div>
            <!--<div class="form-group">
                <label for="input">Visitor's Answer</label>
                <input type="text" class="form-control" id="user_input" name="user_input"  value="<?= $input ?>">
            </div>-->
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link" name="link"  value="<?= $link ?>">
            </div>
            <div class="form-group">
                <label for="image-url1">Image</label>
                <input type="text" class="form-control" id="image-url1" name="image-url1"  value="<?= $url ?>">
            </div>
           
            <div class="form-group">
                <label for="type">Availablity (Please enter the 0 or 1)</label>
                <input type="text" style="width:50px;" class="form-control" id="available" name="type"  value="<?= $available ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" id="submit" name="submit"><?= $modified ?></button>
            <input type="hidden" name="hidden" id="hidden" value="<?= $edit ?>">
            <input type="hidden" id="questionid" name="questionid"value="<?= $questionid ?>">
            <input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
            <input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">
        </form>
    </div>
     </div>

    <?php include('includes/footer.html') ?>