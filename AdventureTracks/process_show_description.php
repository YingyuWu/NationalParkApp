<?php
error_reporting(-1);
ini_set('display_errors', 'off');

//Check for empty fields
$check = ($_POST['check']);
$locat_ID = ($_POST['locatID']);
$query = '';
$roleid = ($_POST['roleID']);
$userid = ($_POST['userID']);
$track_type = ($_POST['trackType']);

//connect to the database
require_once('includes/db_conn.php');
$query1 = "SELECT Location_type, Track_type FROM `Location` WHERE ID='".$locat_ID."'";
$query3 = "SELECT count(*) FROM `questions` INNER JOIN `Location`WHERE `questions`.Locat_ID=`Location`.ID AND `questions`.Question_Type='1' AND `questions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."' AND `Location`.ID='".$locat_ID."'";
$query4 = "SELECT count(*) FROM `FillQuestions` INNER JOIN `Location`WHERE `FillQuestions`.Locat_ID=`Location`.ID AND `FillQuestions`.Question_Type='1' AND `FillQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."' AND `Location`.ID='".$locat_ID."'";
$query5 = "SELECT count(*) FROM `singleQuestions` INNER JOIN `Location`WHERE `singleQuestions`.Locat_ID=`Location`.ID AND `singleQuestions`.Question_Type='1' AND `singleQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."' AND `Location`.ID='".$locat_ID."'";
$query6 = "SELECT count(*) FROM `multiQuestions` INNER JOIN `Location`WHERE `multiQuestions`.Locat_ID=`Location`.ID AND `multiQuestions`.Question_Type='1' AND `multiQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."' AND `Location`.ID='".$locat_ID."'";
$query7 = "SELECT count(*) FROM `matchQuestions` INNER JOIN `Location`WHERE `matchQuestions`.Locat_ID=`Location`.ID AND `matchQuestions`.Question_Type='1' AND `matchQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."' AND `Location`.ID='".$locat_ID."'";
$query8 = "SELECT count(*) FROM `orderQuestions` INNER JOIN `Location`WHERE `orderQuestions`.Locat_ID=`Location`.ID AND `orderQuestions`.Question_Type='1' AND `orderQuestions`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."' AND `Location`.ID='".$locat_ID."'";
$query9 = "SELECT count(*) FROM `factInformation` INNER JOIN `Location`WHERE `factInformation`.Locat_ID=`Location`.ID AND `factInformation`.Question_Type='1' AND `factInformation`.Track_Type='".$track_type."' AND `Location`.User_ID = '".$userid."' AND `Location`.ID='".$locat_ID."'";
$result=$dbc->query($query1);
$row = $result->fetch_assoc();
$location_type=$row['Location_type'];
$tracktypes = $row['Track_type'];
$result=$dbc->query($query3);
$row = $result->fetch_assoc();
$num_text=$row['count(*)'];
$result=$dbc->query($query4);
$row = $result->fetch_assoc();
$num_fill=$row['count(*)'];
$result=$dbc->query($query5);
$row = $result->fetch_assoc();
$num_single=$row['count(*)'];
$result=$dbc->query($query6);
$row = $result->fetch_assoc();
$num_multi=$row['count(*)'];
$result=$dbc->query($query7);
$row = $result->fetch_assoc();
$num_match=$row['count(*)'];
$result=$dbc->query($query8);
$row = $result->fetch_assoc();
$num_order=$row['count(*)'];
$result=$dbc->query($query9);
$row = $result->fetch_assoc();
$num_fact=$row['count(*)'];
$total = $num_fact + $num_fill + $num_match + $num_multi + $num_order + $num_single + $num_text; 
$alltypes = explode(";", $tracktypes);//split
$exists = '0';
if (($key = array_search($track_type, $alltypes)) !== false) {//remove current track type
    	$exists = '1';
}

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
			if($exists == '1'){
				echo "<p>".$row['Title']."</p><br><h3>Description</h3><p>".$row['Description']."</p>
				<br><p><h3> Number Of Questions:&nbsp;".$total."</h3></p>
				<div id='description_menu' style='width:100%;float:left; border-left:1px solid grey'>
				<table style='width:100%'>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='text' onclick='addQuestions(this)'>Add Text/Image Questions</a></td><td><a name='text' onclick='viewQuestionsByPointID(this)'>View Text/Image Questions(".$num_text.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='single' onclick='addQuestions(this)'>Add Single Choice Questions</a></td><td><a name='single' onclick='viewQuestionsByPointID(this)'>View Single Choice Questions(".$num_single.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='multi' onclick='addQuestions(this)'>Add Multiple Choice Questions</a></td><td><a name='multi' onclick='viewQuestionsByPointID(this)'>View Multiple Choice Questions(".$num_multi.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='order' onclick='addQuestions(this)'>Add Correct Order Questions</a></td><td><a name='order' onclick='viewQuestionsByPointID(this)'>View Correct Order Questions(".$num_order.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='match' onclick='addQuestions(this)'>Add Match Questions</a></td><td><a name='match' onclick='viewQuestionsByPointID(this)'>View Match Questions(".$num_match.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='fill' onclick='addQuestions(this)'>Add Fill In Questions</a></td><td><a name='fill' onclick='viewQuestionsByPointID(this)'>View Fill In Questions(".$num_fill.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='fact' onclick='addQuestions(this)'>Add Information</a></td><td><a name='fact' onclick='viewQuestionsByPointID(this)'>View Information(".$num_fact.")</a></td></tr>
				</table>
				</div>";
				
			}else{
				echo "<p>".$row['Title']."</p><br><h3>Description</h3><p>".$row['Description']."</p>
				<br><p><h3> Number Of Questions:&nbsp;".$total."</h3></p>";
				
			}
        		/*$basic = "<p>".$row['Title']."</p><br><h3>Description</h3><p>".$row['Description']."</p>
				<br><p><h3> Number Of Questions:&nbsp;".$total."</h3></p>";
				$advanced ="<div id='description_menu' style='width:100%;float:left; border-left:1px solid grey'>
				<table style='width:100%'>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='text' onclick='addQuestions(this)'>Add Text/Image Questions</a></td><td><a name='text' onclick='viewQuestionsByPointID(this)'>View Text/Image Questions(".$num_text.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='single' onclick='addQuestions(this)'>Add Single Choice Questions</a></td><td><a name='single' onclick='viewQuestionsByPointID(this)'>View Single Choice Questions(".$num_single.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='multi' onclick='addQuestions(this)'>Add Multiple Choice Questions</a></td><td><a name='multi' onclick='viewQuestionsByPointID(this)'>View Multiple Choice Questions(".$num_multi.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='order' onclick='addQuestions(this)'>Add Correct Order Questions</a></td><td><a name='order' onclick='viewQuestionsByPointID(this)'>View Correct Order Questions(".$num_order.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='match' onclick='addQuestions(this)'>Add Match Questions</a></td><td><a name='match' onclick='viewQuestionsByPointID(this)'>View Match Questions(".$num_match.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='fill' onclick='addQuestions(this)'>Add Fill In Questions</a></td><td><a name='fill' onclick='viewQuestionsByPointID(this)'>View Fill In Questions(".$num_fill.")</a></td></tr>
					<tr style='height:50px;'><td style='width:49%;border-right:1px solid grey'><a name='fact' onclick='addQuestions(this)'>Add Information</a></td><td><a name='fact' onclick='viewQuestionsByPointID(this)'>View Information(".$num_fact.")</a></td></tr>
				</table>
				</div>";
				echo $basic.$advanced;
				/*if($roleid == '0'){//normal user and this point is not  adventure track point
					if(location_type =='0' || location_type == '2'){
						echo $basic;
					}
				}else{
					if(location_type =='0' || location_type == '2'){//if not adventure track point, no need to show table
						echo $basic;
					}else{
						echo $basic.$advanced;
					}
					
				}*/
        	
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

