<?php

//require 'filter_session.php';

include '../conn.php';
  
$name=$_REQUEST['Name'];
$Description=$_REQUEST['Description'];
$ParentID=$_REQUEST['ParentID'];

$date_time=strtotime(date('Y-m-d', time()));
$rand_str=rand();
  
$target_dir = "pictures/";
//$target_file = $target_dir . basename($_FILES["file"]["name"]);

$name_file = $rand_str.$date_time.".jpg";

$target_file = $target_dir . $name_file;

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 500000000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }
}

  $sql = "insert into Categories(name,description,parentID,icon,iconsize) values('".$name."','".$Description."','".$ParentID."','categories/pictures/".$name_file ."','20'); ";

  $insert_result=$conn->query($sql);
  $path='categories/pictures/'.$name_file ;  
  
  if($insert_result){
   	  $last_id = $conn->insert_id;
   	  
      echo json_encode(array('result' => 'true','Id'=>$last_id,'Name' => $name,'Path'=>$path,'Iconsize'=>20));
  }else{
      echo json_encode(array('result' => 'false'));
  }
    
   $conn->close();
 
?>