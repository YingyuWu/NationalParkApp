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

$query1 = "SELECT * FROM questions WHERE Locat_ID='".$locat_ID."' AND available = '1'";
$query2 = "SELECT * FROM FillQuestions WHERE Locat_ID='".$locat_ID."' AND available = '1'";
$query3 = "SELECT * FROM singleQuestions WHERE Locat_ID='".$locat_ID."' AND available = '1'";
$query4 = "SELECT * FROM multiQuestions WHERE Locat_ID='".$locat_ID."' AND available = '1'";
$query5 = "SELECT * FROM orderQuestions WHERE Locat_ID='".$locat_ID."' AND available = '1'";
$query = "SELECT Longitude,Latitude FROM Location WHERE ID='".$locat_ID."'";
$obj = new stdClass();
$obj->QuestionType = "Question";

$trackpoints = array();

//get lat and lnt
$point = array();
$result = $dbc->query($query);
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
		        $rowobj->title = "Text or Image Question";
		        $rowobj->description = "";
		        $question = array('q_type' => "open", "q_description" => $row['question'] , "q_answer" => $row['user_input'], "q_response" => $row['answer'], "q_link" => $row['link'], "q_image" => $row['image_url1']);
		        $rowobj->questions = array($question);
		        $trackpoints[] = $rowobj;
		        //$obj->trackpoints = $trackpoints;
		}  
    }
    $result1 = $dbc->query($query2);
	if(!$result1){
		echo json_encode(array('result' => 'false'));
		exit();
	}
	if ($result1->num_rows > 0) {
    // output data of each row
	    while($row = $result1->fetch_assoc()) {
	    		$rowobj = new stdClass();
		        $rowobj->coordinate = $point;
		        $rowobj->title = "Fill In Question";
		        $rowobj->description = "";
		        $question = array('q_type' => "open", "q_description" => $row['question'] , "q_answer" => $row['user_input'], "q_response" => $row['answer_short'], "q_response_extra" => $row['answer_long'],"q_link" => $row['link'], "q_image" => $row['image_url1']);
		        $rowobj->questions = array($question);
		        $trackpoints[] = $rowobj;
		        //$obj->trackpoints = $trackpoints;
		} 
		
    }
    $result1 = $dbc->query($query3);
	if(!$result1){
		echo json_encode(array('result' => 'false'));
		exit();
	}
	if ($result1->num_rows > 0) {
    // output data of each row
	    while($row = $result1->fetch_assoc()) {
	    		$rowobj = new stdClass();
		        $rowobj->coordinate = $point;
		        $rowobj->title = "Single Choice Question";
		        $rowobj->description = "";
		        $options = explode(";",$row['options']);
		        $question = array('q_type' => "single", "q_description" => $row['question'] , "q_answer" => $row['correct_answer'], "q_options" => $options, "q_response" => $row['response'],"q_link" => $row['link'], "q_image" => $row['image_url1']);
		        $rowobj->questions = array($question);
		        $trackpoints[] = $rowobj;
		        //$obj->trackpoints = $trackpoints;
		} 
		
    }
    $result1 = $dbc->query($query4);
	if(!$result1){
		echo json_encode(array('result' => 'false'));
		exit();
	}
	if ($result1->num_rows > 0) {
    // output data of each row
	    while($row = $result1->fetch_assoc()) {
	    		$rowobj = new stdClass();
		        $rowobj->coordinate = $point;
		        $rowobj->title = "Multi Choice Question";
		        $rowobj->description = "";
		        $options = explode(";",$row['options']);
		        $choices = explode(";",$row['correct_answer']);
		        $question = array('q_type' => "multi", "q_description" => $row['question'] , "q_answer" => $choices, "q_options" => $options, "q_response" => $row['response'],"q_link" => $row['link'], "q_image" => $row['image_url1']);
		        $rowobj->questions = array($question);
		        $trackpoints[] = $rowobj;
		        //$obj->trackpoints = $trackpoints;
		} 
		
    }
$obj->trackpoints = $trackpoints;
echo json_encode($obj); 


	

?>