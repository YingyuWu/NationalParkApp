<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'On');

//Check for empty fields
if( empty($_POST['type']))
{
    echo "Please choose a Type";
    exit();
}

//Create short variables
$question = $_POST['question'];
$correct_answer = ($_POST['correct_answer']);
$wrong_answer1 = ($_POST['wrong_answer1']);
$wrong_answer2 = ($_POST['wrong_answer2']);
$wrong_answer3 = ($_POST['wrong_answer3']);
$type = ($_POST['type']);

//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO imagequestions
			-- (questionid, name, choice1, choice2, choice3, answer, questiontype, description,available)
			 VALUES (NULL, '".$question."','".$wrong_answer1."','".$wrong_answer2."','".$wrong_answer3."','".$correct_answer."','".$type."', '1')";

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

