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
if($type == 'order'){
    $query = "SELECT * FROM `orderQuestions` WHERE questionid = '".$questionid."'";
    $result = $dbc->query($query);
    if(!$result){
        echo "No Record Found!";
        exit();
    }
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if($row['type'] == '1'){
                $orderType = $row['type'];
                $question = $row['question'];
                $order1 = $row['order1'];
                $order2 = $row['order2'];
                $order3 = $row['order3'];
                $order4 = $row['order4'];
                $link = $row['link'];
                $url = $row['image_url1'];
                $available = $row['available'];
            }else if($row['type'] == '0'){
                $orderType = $row['type'];
                $question = $row['question'];
                $order1 = $row['image1'];
                $order2 = $row['image2'];
                $order3 = $row['image3'];
                $order4 = $row['image4'];
                $link = $row['link'];
                $url = $row['image_url1'];
                $available = $row['available'];
            }
            
        }
    }
}else{
    echo "Invalid Type";
    exit();
}

?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1>Edit order question</h1>
        <form action="process_edit_order_quiz.php?ordertype=1" name="form1" id="form1" method="post" style="display:none">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" value="<?= $question ?>">
            </div>
            <div class="form-group">
                <label for="correct_order_1">Order 1</label>
                <input type="text" class="form-control" id="correct_order_1" name="correct_order_1" value="<?= $order1 ?>">
            </div>
            <div class="form-group">
                <label for="correct_order_2">Order 2</label>
                <input type="text" class="form-control" id="correct_order_2" name="correct_order_2" value="<?= $order2 ?>">
            </div>
            <div class="form-group">
                <label for="correct_order_3">Order 3</label>
                <input type="text" class="form-control" id="correct_order_3" name="correct_order_3" value="<?= $order3 ?>">
            </div>
            <div class="form-group">
                <label for="correct_order_4">Order 4</label>
                <input type="text" class="form-control" id="correct_order_4" name="correct_order_4" value="<?= $order4 ?>">
            </div>
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
            <button type="submit" class="btn btn-primary btn-large" value="submit" id="submit" name="submit"><?= $modified ?></button>
            <input type="hidden" name="hidden" id="hidden" value="<?= $edit ?>">
            <input type="hidden" id="questionid" name="questionid"value="<?= $questionid ?>">

        </form>

        <form action="process_edit_order_quiz.php?ordertype=0" name="form2" id="form2" method="post" style="display:none">
            <div class="form-group" style="padding-top:20px;">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" name="question" value="<?= $question ?>">
            </div>
            <div class="form-group">
                <label for="correct_order_1">Image 1</label>
                <input type="text" class="form-control" id="correct_order_1" name="correct_order_1" value="<?= $order1 ?>">
            </div>
            <div class="form-group">
                <label for="correct_order_2">Image 2</label>
                <input type="text" class="form-control" id="correct_order_2" name="correct_order_2" value="<?= $order2 ?>">
            </div>
            <div class="form-group">
                <label for="correct_order_3">Image 3</label>
                <input type="text" class="form-control" id="correct_order_3" name="correct_order_3" value="<?= $order3 ?>">
            </div>
            <div class="form-group">
                <label for="correct_order_4">Image 4</label>
                <input type="text" class="form-control" id="correct_order_4" name="correct_order_4" value="<?= $order4 ?>">
            </div>
            <div class="form-group">
                <label for="correct_answer">Link(Optional)</label>
                <input type="text" class="form-control" id="link" name="link" value="<?= $url ?>">
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

<script type="text/javascript">

function init(){
    var orderType = <?php echo json_encode($orderType); ?>;
    if(orderType == '1'){
        document.getElementById("form1").style.display = "inline";
        document.getElementById("form2").style.display = "none";
    }else if(orderType == '0'){
        document.getElementById("form1").style.display = "none";
        document.getElementById("form2").style.display = "inline";
    }
}
  $(document).ready(function(){
    init();
  });

</script>
    <?php include('includes/footer.html') ?>