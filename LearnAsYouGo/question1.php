<?php

//Connect to Db and fetch questions
require_once('includes/db_conn.php');

//Create a query to fetch all the questions
$query = "select * from questions where questiontype = 1"; //question numbers
$queryimage = "select * from images where type = 1"; //query images table
$queryimagequestion = "select * from imagequestions where type = 1"; //query images questions table

//Run the query
$query_result = $dbc->query($query);
$image_result=mysqli_query($dbc,$queryimage);
$query_imageqeustion = $dbc->query($queryimagequestion);


//Count the number of returned items from the database
$num_questions_returned = $query_result->num_rows;

if ($num_questions_returned < 1){
    echo "There is no question in the database";
    exit();}

//Create an array to hold all the returned questions
$questionsArray = array();

//Add all the questions from the result to the questions array

//////////////////////////////////////////////////////////text-query///////////////////
while ($row = $query_result->fetch_assoc()){
    $questionsArray[] = $row;
}

//Create an array of Correct answers


    $correctAnswerArray = array();
foreach($questionsArray as  $question){
    $correctAnswerArray[$question['questionid']] = $question['answer'];
}


//Build the questions array from query result
$questions = array();
foreach($questionsArray as $question) {
    $questions[$question['questionid']] = $question['name'];
 }

$description = array();
foreach($questionsArray as $question) {
    $description[$question['questionid']] = $question['description'];
 } 

$link = array();
foreach($questionsArray as $question) {
    $link[$question['questionid']] = $question['link'];
 } 

//Build the choices array from query result
$choices = array();
foreach ($questionsArray as $row) {
    $choices[$row['questionid']] = array($row['choice1'], $row['choice2'], $row['choice3'], $row['answer']);
  }

///////////////////////////////////////////////////////////////image-query////////////////////

while ($row1 = $query_imageqeustion->fetch_assoc()){
    $questionsArray1[] = $row1;
}

//Create an array of Correct answers


    $correctAnswerArray1 = array();
foreach($questionsArray1 as  $question1){
    $correctAnswerArray1[$question1['questionid']] = $question1['answer'];
}


//Build the questions array from query result
$questions1 = array();
foreach($questionsArray1 as $question1) {
    $questions1[$question1['questionid']] = $question1['name'];
 }


//Build the choices array from query result
$choices1 = array();
foreach ($questionsArray1 as $row1) {
    $choices1[$row1['questionid']] = array($row1['choice1'], $row1['choice2'], $row1['choice3'], $row1['answer']);
  }  

?>


<?php
/**
* index
 */

error_reporting(E_ALL);
ini_set('display_errors', 0);
$rightAnswer = 0;
$wrongAnswer = 0;

require_once('includes/header.html');
require_once('includes/functions_list.php');


if (isset($_POST['submit'])){
  foreach($_POST['response'] as $key => $value){
      if($correctAnswerArray[$key] == $value){
          $rightAnswer++;
      } 
      elseif($correctAnswerArray1[$key] == $value){
          $rightAnswer++;
      } 
      else {
          $wrongAnswer++;
      }
  }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<!-- //Display result-->

<!--Display form-->
<form action="question1.php" method="post">
     <?php
    echo "<h2 style= \"padding-left:30px;\">Description</h2>";
    foreach($description as $id => $description) {
        echo "<div class=\"form-group\">";
        echo "<p style= \"padding-left:30px;\"> $description</p>"."<ol>";//display the description
        echo("</div>");
        }
       ?>

      <?php
    foreach($link as $id => $link) {
        echo "<div class=\"form-group\">";
        echo "<a style= \"padding-left:30px;\" href = \"$link\"> $link</a>"."<ol>";//display the description
        echo("</div>");
        }
       ?>  

     <?php
     echo "<h2 style= \"padding-left:30px; padding-top:30px;\">Images question</h2>";
      while($row = mysqli_fetch_array($image_result))
      {
          echo '<img style= "padding-left:30px; padding-top:10px;" height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
      }
       foreach($questions1 as $id1 => $question1) {
        echo "<div class=\"form-group\">";
        echo "<h5 style= \"padding-left:30px; padding-top:10px;\"> $question1</h5>"."<ol>";//display the question

        //Display multiple choices
        $randomChoices1 = $choices1[$id1];
        $randomChoices1 = shuffle_assoc($randomChoices1);
        foreach ($randomChoices1 as $key => $values){
            echo '<li><input type="radio" name="response['.$id1.'] id="'.$id1.'" value="' .$values.'"/>';
        ?>
            <label for="question-<?php echo($id1); ?>"><?php echo($values);?></label></li>
    <?php

        }
            echo("</ul>");
            echo("</div>");
        } 
     ?>  

    <?php
    echo "<h2 style= \"padding-left:30px; padding-top:30px;\">Text question</h2>";
    foreach($questions as $id => $question) {
        echo "<div class=\"form-group\">";
        echo "<h5 style= \"padding-left:30px; padding-top:10px;\"> $question</h5>"."<ol>";//display the question

        //Display multiple choices
        $randomChoices = $choices[$id];
        $randomChoices = shuffle_assoc($randomChoices);
        foreach ($randomChoices as $key => $values){
            echo '<li><input type="radio" name="response['.$id.'] id="'.$id.'" value="' .$values.'"/>';
        ?>
            <label for="question-<?php echo($id); ?>"><?php echo($values);?></label></li>
    <?php

        }
            echo("</ul>");
            echo("</div>");
        }
       ?>

    <input type="submit" name="submit" class="btn btn-primary" value="Submit Text Quiz" />
</form>

    <?php
       if ($rightAnswer > 0){ ?>
           <h2><span class="label label-success">You have <?php echo $rightAnswer; ?> correct answers</span></h2>
           <?php }
        if ($wrongAnswer > 0) { ?>
           <h2><span class="label label-danger">You have <?php echo $wrongAnswer; ?> wrong answers</span></h2>
           <?php
        }
     ?>

    <?php   include('includes/footer.html'); ?>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-48989039-2', '');
    ga('send', 'pageview');

</script>
</body>
</html>

