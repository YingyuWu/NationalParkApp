<?php

  //require 'filter_session.php';

  include '../conn.php';
  
  $id=$_REQUEST['id'];

  $sql = "delete from Categories where id='".$id."' ; ";

  $result=$conn->query($sql);

  if($result){
      echo json_encode(array('result' => 'true'));
  }else{
      echo json_encode(array('result' => 'false'));
  }
    
  $conn->close();
 
?>