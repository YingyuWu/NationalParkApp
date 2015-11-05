<?php
require_once('includes/db_conn.php');

  
   $sql = "select * from Categories";

   $result = $dbc->query($sql);
   $rows = array();
    
	if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["Title"]. " - Longitude: " . $row["Longitude"]. " " . $row["Latitude"]. "" . $row["Description"]. "<br>";
        //echo json_encode(array('result' => 'true','title' => $row['Title'],'Longitude' => $row['Longitude'],'Latitude' => $row['Latitude'],'Description' => $row['Description']));
        $rows[]=$row;
    }
    
    echo json_encode(array('result' => 'true','data' => $rows));
	} else {
    echo json_encode(array('result' => 'false'));
	}

   
   
   $conn->close();
?>