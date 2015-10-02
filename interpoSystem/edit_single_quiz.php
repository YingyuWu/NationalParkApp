<?php
include('includes/header.html');
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
if($type == 'single'){
    $query = "SELECT * FROM `singleQuestions` WHERE questionid = '".$questionid."'";
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
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1>Edit Single Choice Questions</h1>
        <form action="process_edit_single_quiz.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="question"> Question</label>
                <input type="text" class="form-control" id="question" name="question" value="<?= $question ?>">
            </div>
            <div class="form-group">
                <label for="correct_answer">Options</label>
                <input type="text" class="form-control" id="options" name="options"  value="<?= $options ?>">
            </div>
            <div class="form-group">
                <label for="correct_answer">Correct Answer</label>
                <input type="text" class="form-control" id="correct_answer" name="correct_answer"  value="<?= $correct_answer ?>">
            </div>
           <!-- <div class="form-group">
                <label for="input">Visitor's Answer</label>
                <input type="text" class="form-control" id="user_input" name="user_input"  value="<?= $input ?>">
            </div>-->
            <div class="form-group">
                <label for="link">Response For Correct Answer</label>
                <input type="text" class="form-control" id="response" name="response"  value="<?= $response ?>">
            </div>
            <div class="form-group">
                <label for="link">Response For Wrong Answer</label>
                <input type="text" class="form-control" id="response_wrong" name="response_wrong"  value="<?= $response_wrong ?>">
            </div>
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
            <button type="submit" class="btn btn-primary btn-large" value="submit" id="submit" name="submit"><?= $modified ?></button>
            <input type="hidden" name="hidden" id="hidden" value="<?= $edit ?>">
            <input type="hidden" id="questionid" name="questionid"value="<?= $questionid ?>">
        </form>
    </div>
     </div>

    <?php include('includes/footer.html') ?>