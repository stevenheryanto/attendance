<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="js/jquery-1.9.1.js"></script>
	<title>Absence</title>

	<script>	
	function validateForm(){
		var day = document.myForm.day.value;
		var from = document.myForm.leaved.value;
		var to = document.myForm.returnd.value;
		if (day != 0){
			if (from == 0){
				alert("Leave date is required.");
				return false;
			}
			if (to == 0 ){
				alert("Return date is required.");
				return false;
			}
			if (from > to){
				alert("Return date must be later than leave date.");
				return false;
				}
			}
		if (from != 0){
			if (day == 0){
				alert("Duration is required.");
				return false;
			}
			if (to == 0){
				alert("Return date is required.");
				return false;
			}
		}
		if (to != 0){
			if (day == 0){
				alert("Duration is required.");
				return false;
			}
			if (from == 0){
				alert("Leave date is required.");
				return false;
			}
		}
	}
	 
	$(document).ready(function(){
		d = document.getElementById("reason").value;
		if((d != 1) && (d != 2) && (d != 3)){
			$('#other').removeClass('hidden');
		}
		//alert(d);
	});
	function hide() {
		d = document.getElementById("reason").value;
		if(d == "Other"){
			$('#other').val("").removeClass('hidden');
		}else{
			$('#other').val(d).addClass('hidden');
		}
	}
	
	function goBack()
	{
	window.history.back();
	}	
	
	</script>
	<style>
		* { margin:0; padding: 0; list-style-type: none; }
		body { line-height: 24px; font-size: 16px; }
		.input {
			border: 1px solid #006;
			background: #ffc;
		}
		.input:hover {
			border: 1px solid #f00;
			background: #ff6;
		}
		.button {
			border: 1px solid #006;
			background: #ccf;
			width: 50px;
			text-align: center;
		}
		.button:hover {
			border: 1px solid #f00;
			background: #eef;
		}
		label {
			display: block;
			width: 150px;
			float: left;
			margin: 2px 4px 6px 4px;
			text-align: right;
		}
		br { clear: left; }
		.hidden { display: none; }
	</style>
</head>
	<?php
		$ids = $_GET['id']; 
		require_once 'meekrodb.2.1.class.php';	
		$row = DB::queryFirstRow("SELECT * FROM attlog WHERE id=%s", $ids);
		echo $row['reason'];
	?>
<body>
	<form name="myForm" action="attlogU.php" method="post" onsubmit="return validateForm()">
		<li>
		<input type="hidden" name="id" value="<?= $ids ?>">
		<label>Reason: </label>   
		<select onchange="hide()" id="reason" name="reason">
			<option value=1 <?php if($row['reason'] == 1) echo 'selected' ?> >Sick</option>
			<option value=2 <?php if($row['reason'] == 2) echo 'selected' ?> >No call no show</option>
			<option value=3 <?php if($row['reason'] == 3) echo 'selected' ?> >Leave</option>
			<option value="Other" <?php if(($row['reason'] != 1) && ($row['reason']!=2) && ($row['reason'] !=3 )) echo 'selected' ?> >Other</option>
		</select>
		<input type="text" name="other" id="other" class="hidden"  value="<?php if(($row['reason'] != 1) && ($row['reason']!=2) && ($row['reason'] !=3 )) echo $row['reason'] ?>">
		<br>
		<label>Duration: </label>
		<input type="number" name="day" min=0 max=36 value="<?= $row['day'] ?>" required>
		<br>
		<label>Leave </label>
		<input type="date" name="leaved" value="<?= $row['leaved'] ?>">
		<br>
		<label>Return </label> 
		<input type="date" name="returnd" value="<?= $row['returnd'] ?>"><br>
		<br>
		<label>&nbsp; </label><input class="button" name="submit" type="submit" value="Submit">
		<input class="button" value="Back" onclick="goBack()">
		</li>
	</form>	
</body>
</html>
