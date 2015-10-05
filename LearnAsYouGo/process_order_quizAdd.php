<?php
include('includes/header.html');

error_reporting(-1);
ini_set('display_errors', 'off');


//Create short variables
$question = $_POST['question'];
$correct_order_1 = ($_POST['correct_order_1']);
$correct_order_2 = ($_POST['correct_order_2']);
$correct_order_3 = ($_POST['correct_order_3']);
$correct_order_4 = ($_POST['correct_order_4']);
$locatid = ($_POST['locatid']);
$link = ($_POST['link']);
$url = ($_POST['image-url1']);

//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO orderQuestions
			 (questionid, question, correct_order_1, correct_order_2, correct_order_3, correct_order_4, link, image_url1,available,Locat_ID)
			 VALUES (NULL, '".$question."','".$correct_order_1."','".$correct_order_2."','".$correct_order_3."','".$correct_order_4."','".$link."', '".$url."','1','".$locatid."')";

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

