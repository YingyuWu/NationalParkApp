<?php  
require_once('includes/db_conn.php');
$locat_ID = ($_POST['locatID']);
if($locat_ID == ''){
    echo "locat_ID is invalid";
    exit();
}
$location_type = ($_POST['locationType']);
$option = ($_POST['option']);

$newtype;

if($option == 'add'){
	if($location_type == '0'){//general points
		$newtype = '2';
	}else if($location_type == '1'){//already is AT points, then set as both
		$newtype = '3';
	}
}else if($option == 'remove'){
	if($location_type == '3'){//both
		$newtype = '1';
	}else if($location_type == '2'){
		$newtype = '0';
	}
}
$sql = "UPDATE Location SET Location_type='".$newtype."' WHERE ID='".$locat_ID."'";
$result = $dbc->query($sql);
	//var_dump($Track_ID);
	

?>