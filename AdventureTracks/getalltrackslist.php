<?php

header('Content-Type: application/json');
define('ROOT',dirname(__FILE__).DRECTORY_SEPARATOR."upload");
require_once('includes/db_conn.php');
$query = "SELECT * FROM `AdventureTracks`";
$obj = new stdClass();
$trackslist = array();
$result1 = $dbc->query($query);
	if(!$result1){
		echo json_encode(array('result' => 'false'));
		exit();
	}
	if ($result1->num_rows > 0) {
    // output data of each row
	    while($row = $result1->fetch_assoc()) {
	    		$rowobj = new stdClass();
		        $rowobj->trackID = $row['ID'];
		        $rowobj->trackName = utf8_encode($row['Track_Name']);
		        $rowobj->trackDescirption = utf8_encode($row['Description']);
		        $rowobj->trackImage = utf8_encode($row['Image_url']);
		        $trackslist[] = $rowobj;
		        //$obj->trackpoints = $trackpoints;
		} 
		
    }
$obj->trackslist = $trackslist;
$json = json_encode($obj); 
$json = str_replace('\r','',$json);
$json = str_replace('\n','',$json);
$json = str_replace('\/','/',$json);
echo $json;
?>