<?php
require_once('includes/db_conn.php');
$locat_ID = ($_POST['locatID']);
$roleid = ($_POST['roleID']);
if($locat_ID == ''){
    echo "locat_ID is invalid";
    exit();
}
$location_type = ($_POST['locationType']);
$query1 = "SELECT Title FROM `Location` WHERE ID='".$locat_ID."'";
$query3 = "SELECT count(*) FROM `questions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query4 = "SELECT count(*) FROM `FillQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query5 = "SELECT count(*) FROM `singleQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query6 = "SELECT count(*) FROM `multiQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query7 = "SELECT count(*) FROM `matchQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query8 = "SELECT count(*) FROM `orderQuestions` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$query9 = "SELECT count(*) FROM `factInformation` WHERE Locat_ID='".$locat_ID."' AND Question_Type='0'";
$result=$dbc->query($query1);
$row = $result->fetch_assoc();
$title=$row['Title'];
$result=$dbc->query($query3);
$row = $result->fetch_assoc();
$num_text=$row['count(*)'];
$result=$dbc->query($query4);
$row = $result->fetch_assoc();
$num_fill=$row['count(*)'];
$result=$dbc->query($query5);
$row = $result->fetch_assoc();
$num_single=$row['count(*)'];
$result=$dbc->query($query6);
$row = $result->fetch_assoc();
$num_multi=$row['count(*)'];
$result=$dbc->query($query7);
$row = $result->fetch_assoc();
$num_match=$row['count(*)'];
$result=$dbc->query($query8);
$row = $result->fetch_assoc();
$num_order=$row['count(*)'];
$result=$dbc->query($query9);
$row = $result->fetch_assoc();
$num_fact=$row['count(*)'];
$dbc->close();
 $menu_text = ""; $menu_fill = ""; $menu_single = ""; $menu_multi = ""; $menu_match = ""; $menu_order = ""; $menu_fact = "";
 if($num_text != '0'){
	 $menu_text = '<p> <b>1.Text/Image Questions('.$num_text.')</b>&nbsp;&nbsp;&nbsp;<a name="text" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a name="text" id="question-type" onclick="viewQuestions(this);return false;">Edit Questions</a><br/>';
 }else{
	 $menu_text = '<p><b> 1.Text/Image Questions('.$num_text.')</b>&nbsp;&nbsp;&nbsp;<a name="text" onclick="addQuestions(this);return false;">Add New</a><br/>';
 }
  if($num_fill != '0'){
	 $menu_fill = '<b>2.Fill-in Blank Questions('.$num_fill.')</b>&nbsp;&nbsp;&nbsp;<a name="fill" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a name="fill" id="question-type" onclick="viewQuestions(this);return false;">Edit Questions</a><br/>';
 }else{
	 $menu_fill = '<b>2.Fill-in Blank Questions('.$num_fill.')</b>&nbsp;&nbsp;&nbsp;<a name="fill" onclick="addQuestions(this);return false;">Add New</a><br/>';
 }
  if($num_single!= '0'){
	 $menu_single = '<b>3.Single Choice Questions('.$num_single.')</b>&nbsp;&nbsp;&nbsp;<a name="single" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a name="single" id="question-type" onclick="viewQuestions(this);return false;">Edit Questions</a><br/>';
 }else{
	 $menu_single = '<b>3.Single Choice Questions('.$num_single.')</b>&nbsp;&nbsp;&nbsp;<a name="single" onclick="addQuestions(this);return false;">Add New</a><br/>';
 }
  if($num_multi != '0'){
	 $menu_multi = '<b>4.Multiple Choice Questions('.$num_multi.')</b>&nbsp;&nbsp;&nbsp;<a name="multi" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a name="multi" id="question-type" onclick="viewQuestions(this);return false;">Edit Questions</a><br/>';
 }else{
	 $menu_multi = '<b>4.Multiple Choice Questions('.$num_multi.')</b>&nbsp;&nbsp;&nbsp;<a name="multi" onclick="addQuestions(this);return false;">Add New</a><br/>';
 }
  if($num_match != '0'){
	 $menu_match = '<b>5.Match Questions('.$num_match.')</b>&nbsp;&nbsp;&nbsp;<a name="match" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a name="match" id="question-type" onclick="viewQuestions(this);return false;">Edit Questions</a><br/>';
 }else{
	 $menu_match = '<b>5.Match Order Questions('.$num_match.')</b>&nbsp;&nbsp;&nbsp;<a name="match" onclick="addQuestions(this);return false;">Add New</a><br/>';
 }
  if($num_order != '0'){
	 $menu_order = '<b>6.Correct Order Questions('.$num_order.')</b>&nbsp;&nbsp;&nbsp;<a name="order" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a name="order" id="question-type" onclick="viewQuestions(this);return false;">Edit Questions</a><br/>';
 }else{
	 $menu_order = '<b>6.Correct Order Questions('.$num_order.')</b>&nbsp;&nbsp;&nbsp;<a name="order" onclick="addQuestions(this);return false;">Add New</a><br/>';
 }
  if($num_fact != '0'){
	 $menu_fact = '<b>7.Information('.$num_fact.')</b>&nbsp;&nbsp;&nbsp;<a name="fact" onclick="addQuestions(this);return false;">Add New</a>&nbsp;&nbsp;&nbsp;<a name="fact" id="question-type" onclick="viewQuestions(this);return false;">Edit Questions</a><br/></p>';
 }else{
	 $menu_fact = '<b>7.Information('.$num_fact.')</b>&nbsp;&nbsp;&nbsp;<a name="fact" onclick="addQuestions(this);return false;">Add New</a><br/>';
 }
 $removePoint = '<br><a name='.$locat_ID.' id='.$location_type.' onclick="removePointToLearn(this)"><b> Remove Me From Learn As You Go</b></a></p>';
 if($roleid=='0'){
 	$question = "<p><b>Title: ".$title."</b></p>".$menu_text.$menu_fill.$menu_single.$menu_multi.$menu_match.$menu_order.$menu_fact;
 }else{
 	$question = "<p><b>Title: ".$title."</b></p>".$menu_text.$menu_fill.$menu_single.$menu_multi.$menu_match.$menu_order.$menu_fact.$removePoint;
 }

echo $question;
?>
