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

$query1 = "SELECT * FROM questions WHERE Locat_ID='".$locat_ID."' AND available = '1' AND Question_Type='0'";
$query2 = "SELECT * FROM FillQuestions WHERE Locat_ID='".$locat_ID."' AND available = '1' AND Question_Type='0'";
$query3 = "SELECT * FROM singleQuestions WHERE Locat_ID='".$locat_ID."' AND available = '1' AND Question_Type='0'";
$query4 = "SELECT * FROM multiQuestions WHERE Locat_ID='".$locat_ID."' AND available = '1' AND Question_Type='0'";
$query5 = "SELECT * FROM orderQuestions WHERE Locat_ID='".$locat_ID."' AND available = '1' AND Question_Type='0'";
$query6 = "SELECT * FROM matchQuestions WHERE Locat_ID='".$locat_ID."' AND available = '1' AND Question_Type='0'";
$query7 = "SELECT * FROM factInformation WHERE Locat_ID='".$locat_ID."' AND available = '1' AND Question_Type='0'";
$query = "SELECT * FROM Location WHERE ID='".$locat_ID."'";
$obj = new stdClass();
$obj->QuestionType = "Learn As You Go Question";

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
        $point_title = $row['Title'];
        $point_description= $row['Description'];
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
		        $rowobj->title = $point_title;
		        $rowobj->description = $point_description;
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
		        $rowobj->title = $point_title;
		        $rowobj->description = $point_description;
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
		        $rowobj->title = $point_title;
		        $rowobj->description = $point_description;
		        $options = explode(";",$row['options']);
		        $question = array('q_type' => "single", "q_description" => $row['question'] , "q_answer" => $row['correct_answer'], "q_options" => $options, "q_response" => $row['response'],"q_response_wrong" => $row['response_wrong'],"q_link" => $row['link'], "q_image" => $row['image_url1']);
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
		        $rowobj->title = $point_title;
		        $rowobj->description = $point_description;
		        $options = explode(";",$row['options']);
		        $choices = explode(";",$row['correct_answer']);
		        $question = array('q_type' => "multi", "q_description" => $row['question'] , "q_answer" => $choices, "q_options" => $options, "q_response" => $row['response'],"q_response_wrong" => $row['response_wrong'],"q_link" => $row['link'], "q_image" => $row['image_url1']);
		        $rowobj->questions = array($question);
		        $trackpoints[] = $rowobj;
		        //$obj->trackpoints = $trackpoints;
		} 
		
    }
    $result1 = $dbc->query($query5);
	if(!$result1){
		echo json_encode(array('result' => 'false'));
		exit();
	}
	if ($result1->num_rows > 0) {
    // output data of each row
	    while($row = $result1->fetch_assoc()) {
	    		$rowobj = new stdClass();
		        $rowobj->coordinate = $point;
		        $rowobj->title = $point_title;
		        $rowobj->description = $point_description;
		        $question = array('q_type' => "order", 'order_type' => $row['type'] ,"q_description" => $row['question'] , "q_order1" => $row['order1'],"q_order2" => $row['order2'],"q_order3" => $row['order3'],"q_order4" => $row['order4'] ,"q_link" => $row['link'], "q_image" => $row['image_url1']);
		        $rowobj->questions = array($question);
		        $trackpoints[] = $rowobj;
		        //$obj->trackpoints = $trackpoints;
		} 
		
    }
    $result1 = $dbc->query($query6);
	if(!$result1){
		echo json_encode(array('result' => 'false'));
		exit();
	}
	if ($result1->num_rows > 0) {
    // output data of each row
	    while($row = $result1->fetch_assoc()) {
	    		$rowobj = new stdClass();
		        $rowobj->coordinate = $point;
		        $rowobj->title = $point_title;
		        $rowobj->description = $point_description;
		        $left_options = explode(";",$row['left_options']);
		        $right_options = explode(";",$row['right_options']);
		        $question = array('q_type' => "match", "q_description" => $row['question'] , "left_title"=>$row['left_title'], "right_title"=>$row['right_title'], "q_left_options" => $left_options, "q_right_options" => $right_options,"q_response" => $row['response'],"q_response_wrong" => $row['response_wrong'],"q_link" => $row['link'], "q_image" => $row['image_url1']);
		        $rowobj->questions = array($question);
		        $trackpoints[] = $rowobj;
		        //$obj->trackpoints = $trackpoints;
		} 
		
    }
    $result1 = $dbc->query($query7);
	if(!$result1){
		echo json_encode(array('result' => 'false'));
		exit();
	}
	if ($result1->num_rows > 0) {
    // output data of each row
	    while($row = $result1->fetch_assoc()) {
	    		$rowobj = new stdClass();
		        $rowobj->coordinate = $point;
		        $rowobj->title = $point_title;
		        $rowobj->description = $point_description;
		        $question = array('q_type' => "fact", "q_description" => $row['question'] ,"q_link" => $row['link'], "q_image" => $row['image_url1']);
		        $rowobj->questions = array($question);
		        $trackpoints[] = $rowobj;
		        //$obj->trackpoints = $trackpoints;
		} 
		
    }
$obj->trackpoints = $trackpoints;
echo json_encode($obj); 


	

?>