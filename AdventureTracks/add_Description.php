<?php
include('includes/header.html');

?>
<div class="main"> 
    <div class="left">
         <ul>
       <li><a onclick="viewPoints(this)">Points</a></li>
       <li><a name="text" onclick="viewQuestions(this)">Text/Image Questions</a></li>
       <li><a name="fill" onclick="viewQuestions(this)">Fill In Questions</a></li>
       <li><a name="single" onclick="viewQuestions(this)">Single Choice Questions</a></li>
       <li><a name="multi" onclick="viewQuestions(this)">Multiple Choice Questions</a></li>
       <li><a name="match" onclick="viewQuestions(this)">Match Questions</a></li>
       <li><a name="order" onclick="viewQuestions(this)">Correct Order Questions</a></li>
       <li><a name="fact" onclick="viewQuestions(this)">Information</a></li>
       </ul>
    </div>
    <div class="wrappermiddle">
        <div class="middle" id="main-content">
            <div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1>Add Description</h1>
        <form action="process_description.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="description">Description</label>
                <input type="text" style="width:600px; height:200px;" class="form-control" id="description" name="description" placeholder="Please tell us some knowledge about this">
            </div>
            <div class="form-group" style="padding-top:20px;">
                <label for="link">Add Link</label>
                <input type="text" class="form-control" id="link" name="link" placeholder="Enter your Link here">
            </div>
            <div class="form-group">
                <label for="type">Type (Please enter the point type)</label>
                <input type="text" style="width:50px;" class="form-control" id="type" name="type" placeholder="1">
            </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>
        <input type="hidden" name="user_id" value="hidden" id="user-id">
        <input type="hidden" name="role_id" value="hidden" id="role-id">
        <input type="hidden" name="track_type" value="hidden" id="track-type">

        </form>
    </div>
     </div>
    </div>    
    <!--<div class="right">
        Right column: 
         <br>
         fixed width 200 px 
    </div>  -->   
</div>


    <?php include('includes/footer.html') ?>