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
    <h1>Single Choice Questions</h1>
        <form action="process_add_single_quiz.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="wrong_answer">Options</label>
                <input type="text" class="form-control" id="options" name="options" placeholder="Enter as many as options you want, separate them by ;">
            </div>
            <div class="form-group">
                <label for="correct_answer">Correct answers (id in options)</label>
                <input type="text" style="width:50px;" maxlength="2" size="2" class="form-control" id="correct_answer" name="correct_answer" placeholder="1">
            </div>
            <div class="form-group">
                <label for="response">Response(Optional)</label>
                <input type="text" class="form-control" id="response" name="response" placeholder="Enter response here">
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

<?php include('includes/footer.html'); ?>