<?php
include('includes/header.html');
$locatid = $_GET['locatID'];
if($locatid == ''){
    echo "Location ID is invalid";
    exit();
}
?>
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
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>

        </form>
    </div>
     </div>

    <?php include('includes/footer.html') ?>