<?php
include('includes/header.html');
$locatid = $_GET['locatID'];
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
$track_type = $_GET['trackType'];
if($track_type == ''){
 echo "Track Type is invalid";
  exit();
}
require_once('includes/db_conn.php');
$query = "SELECT * FROM `AdventureTracks` WHERE ID='".$track_type."'";
$result = $dbc->query($query);
$track_name;
$description;
$image_url;
$available;
$point_order;
    if(!$result){
        echo '<h1>System Error</h1>';
        exit();
    }

    if($result->num_rows > 0){
    //Fetch rows
        $row = $result->fetch_assoc();
        $track_name = $row['Track_Name'];
		$description = $row['Description']; 
		$image_url = $row['Image_url'];
		$available = $row['available'];
		$point_order = $row['Point_Order'];
    }
$dbc->close();

?>

    <div class="wrappermiddle">
        <div class="middle" id="main-content">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <h1>Edit Adventure Track</h1>
                    <form action="process_edit_track_quiz.php" method="post" id="form">
                        <div class="form-group" style="padding-top:20px;">
                            <label for="question">Name</label>
                            <input type="text" class="form-control" id="track_name" name="track_name"value="<?= $track_name ?>">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Introduction</label>
                            <input type="text" class="form-control" id="description" name="description" value="<?= $description ?>">
                        </div>
                         <div class="form-group">
                            <label for="correct_answer">Availability</label>
                            <input type="radio" name="available"  id="pub" value="1">Public &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="priv" name="available"  value="0">Private
                        </div>
						<div class="form-group">
                            <label for="correct_answer">Order</label>
                            <input type="radio" name="point_order"  id="point-order-true" value="1">Yes &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="point-order-false" name="point_order"  value="0">No
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Image(Optional)</label>
                            <input type="text" class="form-control" id="image-url1" name="image-url1" value="<?= $image_url ?>">
                        </div>
						<input type="hidden" name="userid" id="hidden" value="<?=$userid ?>">
                        <input type="hidden" name="roleid" id="hidden" value="<?=$roleid ?>">
						<input type="hidden" name="track_type" id="track-type" value="<?=$track_type ?>">
                        <!--
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
                        -->
                        <button type="button" onclick="submitForm()" class="btn btn-primary btn-large" value="submit">Edit Information</button>

                    </form>
                </div>
            </div>
    </div>    
 
</div>

<script type="text/javascript">
var user_id = <?php echo json_encode($userid); ?>;
var role_id = <?php echo json_encode($roleid); ?>;
document.getElementById("menu_intro").style.display = "none";
document.getElementById("menu_points").style.display = "none";
document.getElementById("menu_questions").style.display = "none";
document.getElementById("menu_order").style.display = "none";
document.getElementById("header-user-id").value = user_id;
document.getElementById("header-role-id").value = role_id;
var available = <?php echo json_encode($available); ?>;
var point_order = <?php echo json_encode($point_order); ?>;
if(available == '0'){
	document.getElementById("priv").checked = true;
}else{
	document.getElementById("pub").checked = true;
}
if(point_order == '0'){
	document.getElementById("point-order-false").checked = true;
}else{
	document.getElementById("point-order-true").checked = true;
}
function submitForm(){
    var name = document.getElementById("track_name").value;
    var description = document.getElementById("description").value;
	var image = document.getElementById("image-url1").value;
    var self = this;
    if(name == '' || name == undefined || name.trim() == ''){
        alert("Track Name is empty");
    }else if(description == '' || description == undefined|| description.trim() == ''){
        alert("Introduction is empty");
    //}else if(image == '' || image == undefined|| image.trim() == ''){
        //alert("Image URL is empty");
    }else{
        self.form.submit();
    }
}
function switchTracks(ele){
    window.location = "list.php?userID=" + user_id + "&roleID=" + role_id;
}
</script>

    <?php include('includes/footer.html') ?>