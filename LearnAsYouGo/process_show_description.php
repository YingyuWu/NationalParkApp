<?php
error_reporting(-1);
ini_set('display_errors', 'off');

//Check for empty fields
$check = ($_POST['check']);
$locat_ID = ($_POST['locatID']);
$query = '';

//connect to the database
require_once('includes/db_conn.php');

$query3 = "SELECT count(*) FROM `questions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query4 = "SELECT count(*) FROM `FillQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query5 = "SELECT count(*) FROM `singleQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query6 = "SELECT count(*) FROM `multiQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query7 = "SELECT count(*) FROM `matchQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query8 = "SELECT count(*) FROM `orderQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query9 = "SELECT count(*) FROM `factInformation` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
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
            //if($row['Location_type'] == '1'){
                //echo "<p>".$row['Title']."</p><br><h3>Description</h3><p>".$row['Description']."</p>
                //<br><p><h3> Total Number Of Questions: ".$total."</h3></p>";
            //}else{
                echo "<p>".$row['Title']."</p><br><h3>Description</h3><p>".$row['Description']."</p>
                <br><p><h3> Total Number Of Questions: ".$total."</h3></p>";
            //}
                
            	
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