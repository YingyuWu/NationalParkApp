<?php
error_reporting(-1);
ini_set('display_errors', 'off');

//Check for empty fields
$check = ($_POST['check']);
$locat_ID = ($_POST['locatID']);
$query = '';
$role_id = ($_POST['roleID']);
$user_id = ($_POST['userID']);
$track_type = ($_POST['trackType']);

//connect to the database
require_once('includes/db_conn.php');


//See if we need to update the availability of current selected question
// if($check == 'update'){
// 	$questionid = ($_POST['questionid']);
// 	$value = ($_POST['value']);
// 	$table = '';
// 	if($type == 'text'){
// 		$table = 'questions';
// 	}else if($type == 'fill'){
// 		//$table = 'question';
// 	}else if($type == 'image'){
// 		$table = 'imagequestions';
// 	}else if($type == 'order'){
// 		$table = 'orderQuestions';
// 	}
// 	if($table == ''){
// 		echo "Table is Not Set UP";
// 		exit();
// 	}
// 	if($value == 'on'){
// 		$query = "UPDATE `parkapps`.`".$table."` SET `available` = '1' WHERE `".$table."`.`questionid` = ".$questionid;
// 	}else if($value == 'off'){
// 		$query = "UPDATE `parkapps`.`".$table."` SET `available` = '0' WHERE `".$table."`.`questionid` = ".$questionid;
// 	}
// 	$result = $dbc->query($query);
//     if(!$result){
//         echo "System Error";
//         exit();
//     }
// }else 
if($check == 'review'){
	$query = "SELECT * FROM `Location` WHERE ID = '".$locat_ID."'";
	$result = $dbc->query($query);
    if(!$result){
        echo "System Error";
        exit();
    }
    if($result->num_rows > 0){
        //Fetch rows
        echo "<div style='width:100%; padding-left:10px'><h3>Title</h3> ";
        while($row = $result->fetch_assoc()){
        	//$count++;
        	//$check = $row['available']
        		echo "<p>".$row['Title']."</p><br><h3>Description</h3><p>".$row['Description']."</p>
        		<br><p><h3> Location</h3>".$row['Latitude']." , ".$row['Longitude']."</p><div id='description_menu' style='width:50%;float:left; border-left:1px solid grey'>
                <ul style='border:0px;'><li><a name='text' onclick='addQuestions(this)'>Add Text/Image Questions</a></li><li><a name='single' onclick='addQuestions(this)'>Add Single Choice Questions</a></li><li><a name='multi' onclick='addQuestions(this)'>Add Multiple Choice Questions</a></li><li><a name='order' onclick='addQuestions(this)'>Add Correct Order Questions</a></li><li><a name='match' onclick='addQuestions(this)'>Add Match Questions</a></li><li><a name='fill' onclick='addQuestions(this)'>Add Fill In Questions</a></li><li><a name='fact' onclick='addQuestions(this)'>Add Information</a></li></ul></div>
                <div id='description_menu' style='width:50%;float:right'>
                <ul class='normalul'><li><a name='text' onclick='viewQuestionsByPointID(this)'>View Text/Image Questions</a></li><li><a name='single' onclick='viewQuestionsByPointID(this)'>View Single Choice Questions</a></li><li><a name='multi' onclick='viewQuestionsByPointID(this)'>View Multiple Choice Questions</a></li><li><a name='order' onclick='viewQuestionsByPointID(this)'>View Correct Order Questions</a></li><li><a name='match' onclick='viewQuestionsByPointID(this)'>View Match Questions</a></li><li><a name='fill' onclick='viewQuestionsByPointID(this)'>View Fill In Questions</a></li><li><a name='fact' onclick='viewQuestionsByPointID(this)'>View Information</a></li></ul></div>";
        	
        }
    }else{
        echo "<tr><td>Description is empty.</td></tr>";
    }
    //echo "<a>Edit</a>";

}
if($query == ''){
	echo "Query Not Set Up";
	exit();
}
$dbc->close();
?>

