<?php

header('Content-Type: application/json');

error_reporting(-1);
ini_set('display_errors', 'off');
//Check for empty fields
$locat_ID = ($_GET['locatID']);
if($locat_ID == ''){
	echo json_encode(array('result' => 'false'));
	exit();
}
//connect to the database
require_once('includes/db_conn.php');
$queries = array();
$query1 = "SELECT * FROM questions WHERE Locat_ID='".$locat_ID."' AND available = '1'";
$query2 = "SELECT Longitude,Latitude FROM Location WHERE ID='".$locat_ID."'";
$obj = new stdClass();
$obj->QuestionType = "Text/Image Question";

$trackpoints = array();

//get lat and lnt
$point = array();
$result = $dbc->query($query2);
if(!$result){
		echo json_encode(array('result' => 'false'));
		exit();
}
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $point[0] = $row['Longitude'];
        $point[1] = $row['Latitude'];
    }
}



//echo $queries[0];
	$result1 = $dbc->query($query1);
	if(!$result1){
		echo json_encode(array('result' => 'false'));
		exit();
	}
	if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        $rowobj = new stdClass();
        $rowobj->coordinate = $point;
        $rowobj->title = "Text/Image Question";
        $rowobj->description = "";
        $question = array('q_type' => "open", "q_description" => $row['question'] , "q_answer" => $row['user_input'], "q_response" => $row['answer'], "q_link" => $row['link'], "q_image" => $row['image_url1']);
        $rowobj->questions = array($question);
        $trackpoints[] = $rowobj;
    	//$obj->trackpoints = $trackpoints;
    }
    //echo json_encode($obj);
	}
	$result1 = $dbc->query($query1);
	if(!$result1){
		echo json_encode(array('result' => 'false'));
		exit();
	}
	if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
        $rowobj = new stdClass();
        $rowobj->coordinate = $point;
        $rowobj->title = "Text/Image Question";
        $rowobj->description = "";
        $question = array('q_type' => "open", "q_description" => $row['question'] , "q_answer" => $row['user_input'], "q_response" => $row['answer'], "q_link" => $row['link'], "q_image" => $row['image_url1']);
        $rowobj->questions = array($question);
        $trackpoints[] = $rowobj;
    	
    }
    $obj->trackpoints = $trackpoints;
    echo json_encode($obj);
	}
	

?>