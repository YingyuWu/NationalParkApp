<?php  
require_once('includes/db_conn.php');
$locat_ID = ($_POST['locatID']);
if($locat_ID == ''){
    echo "locat_ID is invalid";
    exit();
}
$location_type = ($_POST['locationType']);
$option = ($_POST['option']);
$track_type = ($_POST['trackType']);
$newtype;
$query = "SELECT Track_type FROM Location WHERE ID='".$locat_ID."'";
$result=$dbc->query($query);
$row = $result->fetch_assoc();
$tracktypes=$row['Track_type'];
$newtracktypes = '';
if($option == 'add'){
	if($location_type == '0'){//general points
		$newtype = '1';
	}else if($location_type == '2'){//already is AT points, then set as both
		$newtype = '3';
	}else{
		$newtype = $location_type;
	}
	$newtracktypes = $tracktypes.$track_type.";";
}else if($option == 'remove'){
	echo $tracktypes;
	$alltypes = explode(";", $tracktypes);//split

	if (($key = array_search($track_type, $alltypes)) !== false) {//remove current track type
    	unset($alltypes[$key]);
    	//var_dump($alltypes);//dump the content to the page
	}
	$size = count($alltypes);
	unset($alltypes[size - 1]);//remove the "" at the end of array
	$size = count($alltypes);
	if($size - 1 == 0){//empty track types, 
		if($location_type == '3'){//both
			$newtype = '2';
		}else if($location_type == '1'){
			$newtype = '0';
		}
		$newtracktypes = '';//no track types
	}else{
		$newtype = $location_type;
		foreach($alltypes as $item){
			if($item == ""){
				continue;
			}
			$newtracktypes = $newtracktypes.$item.";";
		}
		//$newtracktypes = substr($newtracktypes,0,-1);
		//echo $newtracktypes;
	}
	
}

$sql = "UPDATE Location SET Location_type='".$newtype."', Track_type='".$newtracktypes."' WHERE ID='".$locat_ID."'";
echo $sql;
$result = $dbc->query($sql);
		//echo count($alltypes);
	//var_dump($Track_ID);
	

?>