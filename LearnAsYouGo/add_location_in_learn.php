<?php  
require_once('includes/db_conn.php');
$locat_ID = ($_POST['locatID']);
if($locat_ID == ''){
    echo "locat_ID is invalid";
    exit();
}
$location_type = ($_POST['locationType']);

$newtype;
if($location_type == '0'){//general points
	$newtype = '2';
}else if($location_type == '1'){//already is AT points, then set as both
	$newtype = '3';
}
$sql = "UPDATE Location SET Location_type='".$newtype."' WHERE ID='".$locat_ID."'";
$result = $dbc->query($sql);
if($result){
	echo "<script languages=JavaScript> alert(\" Insert learn as you go successfully! \");</script>";
}else{
	echo "<script languages=JavaScript> alert(\" Insert learn as you go false! \");</script>";
}
	//var_dump($Track_ID);
	

?>