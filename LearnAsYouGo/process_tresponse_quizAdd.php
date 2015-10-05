<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'off');

//Check for empty fields
if( empty($_POST['type']))
{
    echo "Please choose a Point Type";
    exit();
}

//Create short variables
$question = $_POST['question'];
$text = ($_POST['text']);
$type = ($_POST['type']);

//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO textRecordQuestions
			-- 
			 VALUES (NULL, '".$question."','".$text."','".$type."')";

$result = $dbc->query($query);

if($result){
    echo "Information has been saved";
} else {
    echo '<h1>System Error</h1>';
}
$dbc->close();

//image uploading part--------------------


//---------------------

include('includes/footer.html');
?>

