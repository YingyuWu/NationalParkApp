<?php
include('includes/header.html');

?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/show_question.css">

</head>
<body>
<div id="navigation">
	<ul>
		<li><a href="javascript:void(0);" id="text" class="selected">Text Question</a></li>
		<li><a href="javascript:void(0);" id="image">Image Question</a></li>
		<li><a href="javascript:void(0);" id="fill">Fill-in Blank Question</a></li>
		<li><a href="javascript:void(0);" id="response">Response Question</a></li>
		<li><a href="javascript:void(0);" id="order">Correct Order Question</a></li>
	</ul>
	<div class="clear"></div>
</div>
<div id="content">
	<p id="content_changer"></p>
</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		//for default 
		$.ajax({ url: 'process_show_questions.php',
			         data: {param: 'text',check:'all'},
			         type: 'post',
			         success: function(output) {
			                      $('#content_changer').html(output);
			                      $("input[type='radio']").click(function(){
										$.ajax({ url: 'process_show_questions.php',
								         data: {questionid: this.id, check: 'update',param:'text', value: this.value, extra: 'all'},
								         type: 'post',
								         success: function(output) {
								                      $('#content_changer').html(output);
								                      
								                  }
										});
									});
			                  }
			});
		$('#navigation ul a').click(function(){
			$('#navigation ul a').removeClass('selected');
			$(this).addClass('selected');
			//call php
			$.ajax({ url: 'process_show_questions.php',
			         data: {param: this.id, check:'all'},
			         type: 'post',
			         success: function(output) {
			                      $('#content_changer').html(output);
			                      $("input[type='radio']").click(function(){
			                      	console.log(this);
										$.ajax({ url: 'process_show_questions.php',
								         data: {questionid: this.id, check: 'update',param:this.className, value: this.value,extra: 'all'},
								         type: 'post',
								         success: function(output) {
								                      $('#content_changer').html(output);
								            
								                  }
										});
									});
			                  }
					});
			});
	});


</script>


    <?php include('includes/footer.html') ?>