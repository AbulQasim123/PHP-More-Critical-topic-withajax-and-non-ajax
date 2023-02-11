<?php
include('db.php');
if(isset($_POST['submit'])){
	$itemArr=$_POST['name'];
	foreach($itemArr as $list){
		if($list!=''){
			$sql="insert into dynamic_field(name) values('$list')";
			$stmt=$con->prepare($sql);
			$stmt->execute();
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		#wrap{width:20%;}
		.my_box{width:100%; padding-bottom:36px;}
		.field_box{float:left;width:80%;}
		.button_box{float:left;width:20%;}
		
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- <script type="text/javascript" src="bootstrap.js"></script> -->
	<link rel="stylesheet" href="bootstrap.css">
	
</head>
<body>
<form method="post">
	<div id="wrap">
		<div class="my_box">
			<div class="field_box">
				<input type="textbox" name="name[]" id="name" class="">
			</div>
			<div class="button_box"><input type="button" name="add_btn" value="Add More" onclick="add_more()" class="btn btn-secondary btn-sm"></div>
		</div>
	</div>
	<input type="submit" value="Add Record" name="submit" class="btn btn-primary btn-sm">
	<input type="hidden" id="box_count" value="1">
</form>

<script src="jquery-1.4.1.min.js"></script>
<script>
	function add_more(){
		var box_count=jQuery("#box_count").val();
		box_count++;
		jQuery("#box_count").val(box_count);
		jQuery("#wrap").append('<div class="my_box" id="box_loop_'+box_count+'"><div class="field_box"><input type="textbox" name="name[]" id="name"></div><div class="button_box"><input type="button" name="submit" id="submit" value="Remove" onclick=remove_more("'+box_count+'") ></div></div>');
	}
	function remove_more(box_count){
		jQuery("#box_loop_"+box_count).remove();
		var box_count=jQuery("#box_count").val();
		box_count--;
		jQuery("#box_count").val(box_count);
	}
</script>
</body>
</html>
