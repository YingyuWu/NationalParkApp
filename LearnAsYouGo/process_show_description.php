<?php
error_reporting(-1);
ini_set('display_errors', 'off');

//Check for empty fields
$check = ($_POST['check']);
$locat_ID = ($_POST['locatID']);
$query = '';

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
        		<br><p><h3> Location</h3>".$row['Latitude']." , ".$row['Longitude']."</p>";
        	
        }
    }else{
        echo "<tr><td>Description is empty. <a>Add New</a></td></tr>";
    }
    //echo "<a>Edit</a>";

}
if($query == ''){
	echo "Query Not Set Up";
	exit();
}
$dbc->close();
?>