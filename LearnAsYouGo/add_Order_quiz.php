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
        <h1>Add order question</h1>
        <input type="button" value="Add Text Order Question" onclick="showText()"> &nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="Add Image Order Question" onclick="showImage()">
        <form action="process_add_order_quiz.php?type=1" name="form1" id="form1" method="post" style="display:none">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="correct_order_1">Order 1</label>
                <input type="text" class="form-control" id="correct_order_1" name="correct_order_1" placeholder="Enter the correct order 1">
            </div>
            <div class="form-group">
                <label for="correct_order_2">Order 2</label>
                <input type="text" class="form-control" id="correct_order_2" name="correct_order_2" placeholder="Enter the correct order 2">
            </div>
            <div class="form-group">
                <label for="correct_order_3">Order 3</label>
                <input type="text" class="form-control" id="correct_order_3" name="correct_order_3" placeholder="Enter the correct order 3">
            </div>
            <div class="form-group">
                <label for="correct_order_4">Order 4</label>
                <input type="text" class="form-control" id="correct_order_4" name="correct_order_4" placeholder="Enter the correct order 4">
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
            <button type="button" onclick="submitForm()" class="btn btn-primary btn-large" value="submit" >+ Add Information</button>

        </form>

        <form action="process_add_order_quiz.php?type=0" name="form2" id="form2" method="post" style="display:none">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" placeholder="Enter your question here">
            </div>
            <div class="form-group">
                <label for="correct_order_1">Image 1</label>
                <input type="text" class="form-control" id="correct_order_1" name="correct_order_1" placeholder="Enter the correct order 1">
            </div>
            <div class="form-group">
                <label for="correct_order_2">Image 2</label>
                <input type="text" class="form-control" id="correct_order_2" name="correct_order_2" placeholder="Enter the correct order 2">
            </div>
            <div class="form-group">
                <label for="correct_order_3">Image 3</label>
                <input type="text" class="form-control" id="correct_order_3" name="correct_order_3" placeholder="Enter the correct order 3">
            </div>
            <div class="form-group">
                <label for="correct_order_4">Image 4</label>
                <input type="text" class="form-control" id="correct_order_4" name="correct_order_4" placeholder="Enter the correct order 4">
            </div>
            <div class="form-group">
                <label for="correct_answer">Link(Optional)</label>
                <input type="text" class="form-control" id="link" name="link" placeholder="Enter url here">
            </div>
            <input type="hidden" name="locatid" id="hidden" value="<?=$locatid ?>">
            <input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
            <input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">
            <button type="button" onclick="submitForm2()" class="btn btn-primary btn-large" value="submit" >+ Add Information</button>

        </form>
    </div>
     </div>
<script type="text/javascript">
function showText(){
    document.getElementById("form2").style.display = "none";
    document.getElementById("form1").style.display = "inline";
}
function showImage(){
    document.getElementById("form1").style.display = "none";
    document.getElementById("form2").style.display = "inline";

}
function submitForm(){
    var question = document.getElementById("question").value;
    var correct1 = document.getElementById("correct_order_1").value;
    var correct2 = document.getElementById("correct_order_2").value;
    var correct3 = document.getElementById("correct_order_3").value;
    var correct4 = document.getElementById("correct_order_4").value;
    var self = this;
    if(question == '' || question == undefined || question.trim() == ''){
        alert("Question is empty");
    }else if(correct1 == '' || correct1 == undefined|| correct1.trim() == ''){
        alert("Correct order 1 is empty");
    }else if(correct2 == '' || correct2 == undefined|| correct2.trim() == ''){
        alert("Correct order 2 is empty");
    }else if(correct3 == '' || correct3 == undefined|| correct3.trim() == ''){
        alert("Correct order 3 is empty");
    }else if(correct4 == '' || correct4 == undefined|| correct4.trim() == ''){
        alert("Correct order 4 is empty");
    }else{
        self.form1.submit();
    }
}

function submitForm2(){
    var question = document.getElementsByName("question")[1].value;
    var correct1 = document.getElementsByName("correct_order_1")[1].value;
    var correct2 = document.getElementsByName("correct_order_2")[1].value;
    var correct3 = document.getElementsByName("correct_order_3")[1].value;
    var correct4 = document.getElementsByName("correct_order_4")[1].value;
    var self = this;
    if(question == '' || question == undefined || question.trim() == ''){
        alert("Question is empty");
    }else if(correct1 == '' || correct1 == undefined|| correct1.trim() == ''){
        alert("Image 1 url is empty");
    }else if(correct2 == '' || correct2 == undefined|| correct2.trim() == ''){
        alert("Image 2 url is empty");
    }else if(correct3 == '' || correct3 == undefined|| correct3.trim() == ''){
        alert("Image 3 url is empty");
    }else if(correct4 == '' || correct4 == undefined|| correct4.trim() == ''){
        alert("Image 4 url is empty");
    }else{
        self.form2.submit();
    }
}
</script>
    <?php include('includes/footer.html') ?>
	