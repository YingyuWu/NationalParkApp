<?php
error_reporting(-1);
ini_set('display_errors', 'off');

//Check for empty fields
$type = ($_POST['param']);
$check = ($_POST['check']);
$locat_ID = ($_POST['locatID']);
$extra = ($_POST['extra']);
$role_id = ($_POST['roleID']);
$user_id = ($_POST['userID']);
$query = '';
$track_type = ($_POST['trackType']);
//connect to the database
require_once('includes/db_conn.php');


//See if we need to update the availability of current selected question
if($check == 'update'){
	$questionid = ($_POST['questionid']);
	$value = ($_POST['value']);
	$table = '';
	if($type == 'text'){
		$table = 'questions';
	}else if($type == 'fill'){
		$table = 'FillQuestions';
	}else if($type == 'image'){
		$table = 'imagequestions';
	}else if($type == 'order'){
		$table = 'orderQuestions';
	}else if($type == 'single'){
        $table = 'singleQuestions';
    }else if($type == 'multi'){
        $table = 'multiQuestions';
    }else if($type == 'fact'){
        $table = 'factInformation';
    }else if($type == 'match'){
        $table = 'matchQuestions';
    }
	if($table == ''){
		echo "Table is Not Set UP";
		exit();
	}
	if($value == 'on'){
		$query = "UPDATE `parkapps`.`".$table."` SET `available` = '1' WHERE `".$table."`.`questionid` = ".$questionid;
	}else if($value == 'off'){
		$query = "UPDATE `parkapps`.`".$table."` SET `available` = '0' WHERE `".$table."`.`questionid` = ".$questionid;
	}
	$result = $dbc->query($query);
    if(!$result){
        echo "System Error";
        exit();
    }
}

if( $check == 'review'&& $locat_ID == ''){
    echo "Location ID Error";
    //exit();
}
if($role_id == '0'){
    $title = "<tr><td>Question ID</td><td>Question</td><td>Avalibility</td><td>Update</td></tr>";
}else if($role_id == '1'){
    $title = "<tr><td style='width:20%'>Question ID</td><td style='width:80%'>Question</td></tr>";
}else{
    echo "Role ID is invalid";
    exit();
}

//Create the search query
if($type == 'text'){
	//$table = 'questions';
    if($check == 'all' || $extra == 'all'){//extra control
        $query = "SELECT questionid,question,available FROM `questions` WHERE Question_Type='1' AND Track_Type='".$track_type."'";
    }else{
        $query = "SELECT questionid,question,available FROM `questions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='1' AND Track_Type='".$track_type."'";
    }
	$count = 0;
	$result = $dbc->query($query);
	if(!$result){
    	echo '<h1>System Error</h1>';
    	exit();
	}
	echo "<table id='query_result'>";
    if($result->num_rows > 0){
        //Fetch rows
        echo $title;
        while($row = $result->fetch_assoc()){
            if($role_id == '0'){
                $count++;
                $check = $row['available'];
                if($check ==  1){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = 'text' value='on' checked>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;
                    <input type='radio' class='text' id = '".$row['questionid']."'name='available".$count."' value='off'>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' href='edit_text_quiz.php?type=text&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' class='text' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a name='".$row['questionid']."' class='text' id='delete-question' href='edit_text_quiz.php?type=text&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else if($check == 0){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = 'text' value='on'>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;<input type='radio' class='text' id = '".$row['questionid']."' name='available".$count."' value='off' checked>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' class='text' href='edit_text_quiz.php?type=text&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a id='update-question' name='".$row['questionid']."' class='text' href='edit_text_quiz.php?type=text&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else{
                    echo "Available is Not Set";
                    exit();
                } 
            }else if($role_id == '1'){//regular user
        	   echo "<tr><td style='width:20%'>".$row['questionid']."</td><td style='width:80%'>".$row['question']."</td></tr>";
            }
        }
    }else{
        echo "<tr><td>No results matching</td></tr>";
    }
    echo "</table>";
}else if($type == 'fill'){
	//$table = 'FillQuestions';
    if($check == 'all' || $extra == 'all'){//extra control
        $query = "SELECT questionid,question,available FROM `FillQuestions` WHERE Question_Type='1' AND Track_Type='".$track_type."'";
    }else{
        $query = "SELECT questionid,question,available FROM `FillQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='1' AND Track_Type='".$track_type."'";
    }
    $count = 0;
    $result = $dbc->query($query);
    if(!$result){
        echo '<h1>System Error</h1>';
        exit();
    }
    echo "<table id='query_result'>";
    if($result->num_rows > 0){
        //Fetch rows
        echo $title;
        while($row = $result->fetch_assoc()){
            if($role_id == '0'){
                $count++;
                $check = $row['available'];
                if($check ==  1){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on' checked>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;
                    <input type='radio' class='".$type."' id = '".$row['questionid']."'name='available".$count."' value='off'>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' href='edit_fill_quiz.php?type=fill&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' class='".$type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a name='".$row['questionid']."' class='".$type."' id='delete-question' href='edit_fill_quiz.php?type=fill&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else if($check == 0){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on'>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;<input type='radio' class='".$type."' id = '".$row['questionid']."' name='available".$count."' value='off' checked>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' class='".$type."' href='edit_fill_quiz.php?type=fill&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a id='update-question' name='".$row['questionid']."' class='".$type."' href='edit_fill_quiz.php?type=fill&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else{
                    echo "Available is Not Set";
                    exit();
                } 
            }else if($role_id == '1'){//regular user
               echo "<tr><td style='width:20%'>".$row['questionid']."</td><td style='width:80%'>".$row['question']."</td></tr>";
            }   
        }
    }else{
        echo "<tr><td>No results matching</td></tr>";
    }
    echo "</table>";
}else if($type == 'single'){
	//$table = 'singleQuestions';
	if($check == 'all' || $extra == 'all'){//extra control
        $query = "SELECT questionid,question,available FROM `singleQuestions` WHERE Question_Type='1' AND Track_Type='".$track_type."'";
    }else{
        $query = "SELECT questionid,question,available FROM `singleQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='1' AND Track_Type='".$track_type."'";
    }
    $count = 0;
    $result = $dbc->query($query);
    if(!$result){
        echo '<h1>System Error</h1>';
        exit();
    }
    echo "<table id='query_result'>";
    if($result->num_rows > 0){
        //Fetch rows
        echo $title;
        while($row = $result->fetch_assoc()){
            if($role_id == '0'){
                $count++;
                $check = $row['available'];
                if($check ==  1){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on' checked>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;
                    <input type='radio' class='".$type."' id = '".$row['questionid']."'name='available".$count."' value='off'>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' href='edit_single_quiz.php?type=single&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' class='".$type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a name='".$row['questionid']."' class='".$type."' id='delete-question' href='edit_single_quiz.php?type=single&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else if($check == 0){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on'>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;<input type='radio' class='".$type."' id = '".$row['questionid']."' name='available".$count."' value='off' checked>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' class='".$type."' href='edit_single_quiz.php?type=single&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a id='update-question' name='".$row['questionid']."' class='".$type."' href='edit_single_quiz.php?type=single&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else{
                    echo "Available is Not Set";
                    exit();
                }  
            }else if($role_id == '1'){//regular user
               echo "<tr><td style='width:20%'>".$row['questionid']."</td><td style='width:80%'>".$row['question']."</td></tr>";
            } 
            
        }
    }else{
        echo "<tr><td>No results matching</td></tr>";
    }
    echo "</table>";

}else if($type == 'order'){
	//$table = 'orderQuestions';
    if($check == 'all' || $extra == 'all'){//extra control
        $query = "SELECT questionid,question,available FROM `orderQuestions` WHERE Question_Type='1' AND Track_Type='".$track_type."'";
    }else{
        $query = "SELECT questionid,question,available FROM `orderQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='1' AND Track_Type='".$track_type."'";
    }
	$count = 0;
	$result = $dbc->query($query);
	if(!$result){
    	echo '<h1>System Error</h1>';
    	exit();
	}
	echo "<table id='query_result'>";
    if($result->num_rows > 0){
        //Fetch rows
        echo $title;
        while($row = $result->fetch_assoc()){
            if($role_id == '0'){
                $count++;
                $check = $row['available'];
                if($check ==  1){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on' checked>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;
                    <input type='radio' class='".$type."' id = '".$row['questionid']."'name='available".$count."' value='off'>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' href='edit_order_quiz.php?type=order&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' class='".$type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a name='".$row['questionid']."' class='".$type."' id='delete-question' href='edit_order_quiz.php?type=order&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else if($check == 0){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on'>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;<input type='radio' class='".$type."' id = '".$row['questionid']."' name='available".$count."' value='off' checked>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' class='".$type."' href='edit_order_quiz.php?type=order&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a id='update-question' name='".$row['questionid']."' class='".$type."' href='edit_order_quiz.php?type=order&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else{
                    echo "Available is Not Set";
                    exit();
                }
            }else if($role_id == '1'){//regular user
               echo "<tr><td style='width:20%'>".$row['questionid']."</td><td style='width:80%'>".$row['question']."</td></tr>";
            } 
        	   
        }
    }else{
        echo "<tr><td>No results matching</td></tr>";
    }
    echo "</table>";
}else if($type == 'multi'){
    if($check == 'all' || $extra == 'all'){//extra control
        $query = "SELECT questionid,question,available FROM `multiQuestions` WHERE Question_Type='1' AND Track_Type='".$track_type."'";
    }else{
        $query = "SELECT questionid,question,available FROM `multiQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='1' AND Track_Type='".$track_type."'";
    }
    $count = 0;
    $result = $dbc->query($query);
    if(!$result){
        echo '<h1>System Error</h1>';
        exit();
    }
    echo "<table id='query_result'>";
    if($result->num_rows > 0){
        //Fetch rows
        echo $title;
        while($row = $result->fetch_assoc()){
            if($role_id == '0'){
                $count++;
                $check = $row['available'];
                if($check ==  1){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on' checked>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;
                    <input type='radio' class='".$type."' id = '".$row['questionid']."'name='available".$count."' value='off'>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' href='edit_multi_quiz.php?type=multi&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' class='".$type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a name='".$row['questionid']."' class='".$type."' id='delete-question' href='edit_multi_quiz.php?type=multi&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else if($check == 0){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on'>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;<input type='radio' class='".$type."' id = '".$row['questionid']."' name='available".$count."' value='off' checked>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' class='".$type."' href='edit_multi_quiz.php?type=multi&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a id='update-question' name='".$row['questionid']."' class='".$type."' href='edit_multi_quiz.php?type=multi&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else{
                    echo "Available is Not Set";
                    exit();
                }
            }else if($role_id == '1'){//regular user
               echo "<tr><td style='width:20%'>".$row['questionid']."</td><td style='width:80%'>".$row['question']."</td></tr>";
            } 
            
        }   
    }else{
        echo "<tr><td>No results matching</td></tr>";
    }
    echo "</table>";
}else if($type == 'fact'){
    if($check == 'all' || $extra == 'all'){//extra control
        $query = "SELECT questionid,question,available FROM `factInformation` WHERE Question_Type='1' AND Track_Type='".$track_type."'";
    }else{
        $query = "SELECT questionid,question,available FROM `factInformation` WHERE Locat_ID='".$locat_ID."' AND Question_Type='1' AND Track_Type='".$track_type."'";
    }
    $count = 0;
    $result = $dbc->query($query);
    if(!$result){
        echo '<h1>System Error</h1>';
        exit();
    }
    echo "<table id='query_result'>";
    if($result->num_rows > 0){
        //Fetch rows
        echo $title;
        while($row = $result->fetch_assoc()){
            if($role_id == '0'){
                $count++;
                $check = $row['available'];
                if($check ==  1){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on' checked>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;
                    <input type='radio' class='".$type."' id = '".$row['questionid']."'name='available".$count."' value='off'>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' href='edit_fact_quiz.php?type=fact&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' class='".$type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a name='".$row['questionid']."' class='".$type."' id='delete-question' href='edit_fact_quiz.php?type=fact&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else if($check == 0){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on'>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;<input type='radio' class='".$type."' id = '".$row['questionid']."' name='available".$count."' value='off' checked>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' class='".$type."' href='edit_fact_quiz.php?type=fact&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a id='update-question' name='".$row['questionid']."' class='".$type."' href='edit_fact_quiz.php?type=fact&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else{
                    echo "Available is Not Set";
                    exit();
                }
            }else if($role_id == '1'){//regular user
               echo "<tr><td style='width:20%'>".$row['questionid']."</td><td style='width:80%'>".$row['question']."</td></tr>";
            } 
            
        }  
    }else{
        echo "<tr><td>No results matching</td></tr>";
    }
    echo "</table>";
}else if($type == 'match'){
    if($check == 'all' || $extra == 'all'){//extra control
        $query = "SELECT questionid,question,available FROM `matchQuestions` WHERE Question_Type='1' AND Track_Type='".$track_type."'";
    }else{
        $query = "SELECT questionid,question,available FROM `matchQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='1' AND Track_Type='".$track_type."'";
    }
    $count = 0;
    $result = $dbc->query($query);
    if(!$result){
        echo '<h1>System Error</h1>';
        exit();
    }
    echo "<table id='query_result'>";
    if($result->num_rows > 0){
        //Fetch rows
        echo $title;
        while($row = $result->fetch_assoc()){
            if($role_id == '0'){
                $count++;
                $check = $row['available'];
                if($check ==  1){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on' checked>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;
                    <input type='radio' class='".$type."' id = '".$row['questionid']."'name='available".$count."' value='off'>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' href='edit_match_quiz.php?type=match&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' class='".$type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a name='".$row['questionid']."' class='".$type."' id='delete-question' href='edit_match_quiz.php?type=match&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else if($check == 0){
                    echo "<tr><td>".$row['questionid']."</td><td>".$row['question']."</td><td><input type='radio' 
                    id = '".$row['questionid']."' name='available".$count."' class = '".$type."' value='on'>&nbsp;&nbsp;On &nbsp;&nbsp;&nbsp;<input type='radio' class='".$type."' id = '".$row['questionid']."' name='available".$count."' value='off' checked>&nbsp;&nbsp;Off</td>
                    <td><a id='update-question' class='".$type."' href='edit_match_quiz.php?type=match&edit=edit&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."' name='".$row['questionid']."'>Edit</a>&nbsp;&nbsp;
                    <a id='update-question' name='".$row['questionid']."' class='".$type."' href='edit_match_quiz.php?type=match&edit=delete&id=".$row['questionid']."&userID=".$user_id."&roleID=".$role_id."&trackType=".$track_type."'>Delete</a></td></tr>";
                }else{
                    echo "Available is Not Set";
                    exit();
                }
            }else if($role_id == '1'){//regular user
               echo "<tr><td style='width:20%'>".$row['questionid']."</td><td style='width:80%'>".$row['question']."</td></tr>";
            } 
            
        }  
    }else{
        echo "<tr><td>No results matching</td></tr>";
    }
    echo "</table>";
}


if($query == ''){
	echo "Query Not Set Up";
	exit();
}
$dbc->close();

?>