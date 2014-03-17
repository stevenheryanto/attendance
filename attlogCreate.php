<!DOCTYPE html>
<html class="no-js">
<head>
	<script src="js/modernizr-latest.js"></script>
	<script src="js/jquery-1.9.1.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	window.history.back()
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
<?php	$id = $_GET['id'] ?>
</head>
<body>
	<form name="myForm" action="attlogC.php" method="post" onsubmit="return validateForm()">
		<li>
		<input type="hidden" name="id" value="<?= $id ?>">
		<label>Reason: </label>   
		<select onchange="hide()" id="reason" name="reason">
			<option value=1>Sick</option>
			<option value=2>No call no show</option>
			<option value=3>Leave</option>
			<option value="Other">Other</option>
		</select>
		<input type="text" name="other" id="other" class="hidden">
		<br>
		<label>Duration: </label>
		<input type="number" name="day" min=0 max=36 required>
		<br>
		<label>Leave </label>
		<input type="date" name="leaved">
		<br>
		<label>Return </label> 
		<input type="date" name="returnd"><br>
		<br>
		<label>&nbsp; </label><input class="button" name="submit" type="submit" value="Submit">
		<input class="button" value="Back" onclick="goBack()">
		</li>
	</form>
    

</body>
</html>
