<?php 

  	//if(!isset($_SESSION)){
        //session_start();
    	//}
/*
    if(!isset($_SESSION['username'])){
		header("Location:../index.php");
  	}else{
*/
  		require_once('includes/db_conn.php'); 		//need update
  		//$token = mt_rand(0,1000000);
  		//$_SESSION['token'] = $token;
  		//$_SESSION['id'] = $_SESSION['id'];
  		$longitude_input = $_GET['lng'];
  		$latitude_input = $_GET['lat'];
		$userid = $_GET['userID'];
		$roleid = $_GET['roleID'];
  		if ($_POST['submit']) {
  			
	  			$my_date = date("Y-m-d H:i:s");
	  			//,Location_type need add
	  			$sql = "INSERT INTO Location(Title,Longitude,Latitude,Description,Createdate,User_ID,Categories_ID,Location_type,Pub_Or_Priva) VALUES('".$_POST['Title']."','".$_POST['Longitude']."','".$_POST['Latitude']."','".$_POST['Description']."','".$my_date."',".$userid.",".$_POST['add_categories_id'].",2,1);";
	  			$result = $dbc->query($sql);
	  			if($dbc->affected_rows > 0)
	  			{
					$last_id = mysqli_insert_id($dbc);
					//echo json_encode(array('result' => 'true','id' => $last_id,'titile' => $_POST['Title'],'longtitude' => '$longitude_input','latitude' => $latitude_input,'description' => $_POST['Description']));
	  				echo "<script language=JavaScript> alert(\"Insert successfully!\"); </script>";
					echo "<script type=\"text/javascript\">window.location='map.php?userID=".$userid."&roleID=".$roleid."'</script>";
	  			}else{
					//echo json_encode(array('result' => 'false'));
	  				echo "<script language=JavaScript> alert(\"Insert Failed!\"); </script>";
	  			}
  			//}else{  
			//	echo "<script language=JavaScript> alert(\"have submitted the form\"); </script>";  
		 	//}
		        //}	
		         
  		}
	 
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Parkapps</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script type="text/javascript" src="./js/jquery-1.8.3.min.js"></script>

	<!-- Open Sans font from Google CDN -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

	<!-- Pixel Admin's stylesheets -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/pixel-admin.min.css" rel="stylesheet" type="text/css">
	<link href="css/widgets.min.css" rel="stylesheet" type="text/css">
	<link href="css/rtl.min.css" rel="stylesheet" type="text/css">
	<link href="css/themes.min.css" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script src="assets/javascripts/ie.min.js"></script>
	<![endif]-->

    <link rel="stylesheet" href="js/jqwidgets/styles/jqx.base.css" type="text/css" />
    
    <!-- Get jQuery from Google CDN -->
	<!--[if !IE]> -->
		<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
	<!-- <![endif]-->
	<!--[if lte IE 9]>
		<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
	<![endif]-->

    <script type="text/javascript" src="js/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqxpanel.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqxtree.js"></script>
    <script type="text/javascript" src="js/jqwidgets/jqxcheckbox.js"></script>
    
<script type="text/javascript">
$(document).ready(function()
{
	$(".cate_parent0").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+id;

		$.ajax
		({
			type: "POST",
			url: "get_cate_parent1.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".cate_parent1").html(html);
			}
		});
	});
	
	$(".cate_parent1").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+id;

		$.ajax
		({
			type: "POST",
			url: "get_cate_child.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".cate_child").html(html);
			}
		});
	});

});
</script>
</head>
<body>
<style>
#maincontent{
	height:600px;

	width:900px;

	margin:200px auto 0 auto; 
}
table{
	border-collapse:   separate;   border-spacing:   18px;     
}
#cate{
	position:absolute;
	width:220px;
	height:300px;
	left:830px;
	top:150px;
	
}
</style>
<script>var init = [];</script>

<script type="text/javascript">
function get_cateID()
{
	var selectedItem = $('#jqxWidget').jqxTree('selectedItem');

	if(selectedItem!=null){
		document.getElementById('add_categories_id').value=selectedItem.id;
	}else{
		alert("Please select a category");
		return true;
	}
}
	$(document).ready(function () {
            $.ajax({
            	type: 'GET',
            	dataType: 'json',
            	url: 'loadtree.php',  
    			success: function(data){

    			// prepare the data
                var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'id' },
                        { name: 'parentID' },
                        { name: 'name' },
                        { name: 'icon' },
                        { name: 'iconsize' }
                    ],
                    id: 'ID',
                    localdata: data
                };

                // create data adapter.
                var dataAdapter = new $.jqx.dataAdapter(source);
                // perform Data Binding.
                dataAdapter.dataBind();
                // get the tree items. The first parameter is the item's id. The second parameter is the parent item's id. The 'items' parameter represents 
                // the sub items collection name. Each jqxTree item has a 'label' property, but in the JSON data, we have a 'text' field. The last parameter 
                // specifies the mapping between the 'text' and 'label' fields.  
                var records = dataAdapter.getRecordsHierarchy('id', 'parentID', 'items', [{ name: 'name', map: 'label'}]);
                $('#jqxWidget').jqxTree({ source: records, width: '300px'});},
        		error:function(){
            		alert("failure");
        		}
				});
		

						

            });

	
	
</script>

<div id="maincontent">
<form id="form" name="form" method="post" action="" onsubmit="get_cateID()">

<table border="0">

<h3>&nbsp;&nbsp;&nbsp;Input Single Point</h3>
	<tr>
		<td align="right"><label>Title</label></td>
		<td><input type="text" name="Title" id="Title" value="" /></td>				
	</tr>
	<tr>
		<td align="right"><label>Longitude</label></td>
		<td><input type="text" name="Longitude" id="Longitude" value="<?php echo $longitude_input; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><label>Latitude</label></td>
		<td><input type="text" name="Latitude" id="Latitude" value="<?php echo $latitude_input; ?>" /></td>
	</tr>
	<tr>
		<td align="right"><label>Description</label></td>
		<td><textarea name="Description" id="Description" cols="21" rows="3"></textarea></td>
	</tr>
	
	<tr>		
		<td><input type=hidden name='add_categories_id' id='add_categories_id' value='' /></td>
		<td><input class="sub" type="submit" name="submit" value="submit"/></td>
	</tr>		
</table>
	<div id="cate">
	        <table width="310">
	        <tr>
			  <td><label>Categories</label></td>
					
					<td><div class="panel-body">
						    <div id='jqxWidget'>
	        				</div>
	        				
	        		 <div style='margin-top: 10px;'>
		  		 </div>		
					</div>
	                </td>
			</tr>
	  </div>
</form>
</div>

</body>
</html>