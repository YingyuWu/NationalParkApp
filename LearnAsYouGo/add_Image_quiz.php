<?php include('includes/header.html'); ?>


<?php
    ini_set('mysql.connect_timeout',300);
    ini_set('default_socket_timeout',300);
?>
<html>
    <body>
    	<div class="row">
        <div class="col-md-offset-2 col-md-8">
        <h1>Add Image Questions</h1>
        <form method="post" enctype="multipart/form-data">
        <br/>
            <input type="file" name="image" />

            <div class="form-group" style="padding-top:30px;">
                <label for="type">Type (Please enter the point type)</label>
                <input type="text" style="width:50px;" class="form-control" id="type" name="type" placeholder="1">
            </div>

            <br/>
            <input class="btn btn-primary btn-large" type="submit" name="sumit" value="Upload" />
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <form action="process_imageQuizAdd.php" method="post">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Ask Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="correct_answer">Correct answer</label>
                <input type="text" class="form-control" id="correct_answer" name="correct_answer" placeholder="Enter the correct answer here">
            </div>
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
            <div class="form-group">
                <label for="type">Type (Please enter the point type)</label>
                <input type="text" style="width:50px;" class="form-control" id="type" name="type" placeholder="1">
            </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">+ Add Information</button>

        </form>
    </div>
     </div>

        <?php
            if(isset($_POST['sumit']))
            {
                if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
                {
                    echo "Please select an image.";
                }
                elseif( empty($_POST['type']))
                {
                    echo "Please choose a Type";
                 }
                else
                {
                    $image= addslashes($_FILES['image']['tmp_name']);
                    $name= addslashes($_FILES['image']['name']);
                    $image= file_get_contents($image);
                    $image= base64_encode($image);
                    $type = $_POST['type'];
                    saveimage($name,$image,$type);
                }
            }
            function saveimage($name,$image,$type)
            {
                require_once('includes/db_conn.php');
                $qry="insert into images (name,image,type) values ('$name','$image','$type')";
                $result=mysqli_query($dbc,$qry);
                if($result)
                {
                    echo "<br/>Image uploaded.";
                }
                else
                {
                    echo "<br/>Image not uploaded.";
                }
            }
        ?>
    </body>
</html>
<?php include('includes/footer.html'); ?>