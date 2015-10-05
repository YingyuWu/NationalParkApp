<?php
include('includes/header.html');

?>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1>Add Text Response Question</h1>
        <form action="process_tresponse_quizAdd.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Ask Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="type">Type (Please enter the point type)</label>
                <input type="text" style="width:50px;" class="form-control" id="type" name="type" placeholder="1">
            </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>

        </form>
    </div>
     </div>

<div class="row" style="padding-top:50px;">
    <div class="col-md-offset-2 col-md-8">
        <h1>Add Audio Response Question</h1>
        <form action="process_audio_quizAdd.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Ask Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="type">Type (Please enter the point type)</label>
                <input type="text" style="width:50px;" class="form-control" id="type" name="type" placeholder="1">
            </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>

        </form>
    </div>
     </div>     

<div class="row" style="padding-top:50px;">
    <div class="col-md-offset-2 col-md-8">
        <h1>Add picture Response Question</h1>
        <form action="process_pic_quizAdd.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Ask Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="type">Type (Please enter the point type)</label>
                <input type="text" style="width:50px;" class="form-control" id="type" name="type" placeholder="1">
            </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>

        </form>
    </div>
     </div> 

<div class="row" style="padding-top:50px;">
    <div class="col-md-offset-2 col-md-8">
        <h1>Add Video Response Question</h1>
        <form action="process_video_quizAdd.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Ask Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="type">Type (Please enter the point type)</label>
                <input type="text" style="width:50px;" class="form-control" id="type" name="type" placeholder="1">
            </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>

        </form>
    </div>
     </div> 

 <div class="row" style="padding-top:50px;">
    <div class="col-md-offset-2 col-md-8">
        <h1>Add GPS Response Question</h1>
        <form action="process_gps_quizAdd.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Ask Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="type">Type (Please enter the point type)</label>
                <input type="text" style="width:50px;" class="form-control" id="type" name="type" placeholder="1">
            </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>

        </form>
    </div>
     </div>          
    <?php include('includes/footer.html') ?>