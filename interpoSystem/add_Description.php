<?php
include('includes/header.html');

?>
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

        </form>
    </div>
     </div>

    <?php include('includes/footer.html') ?>