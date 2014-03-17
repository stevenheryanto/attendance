<!DOCTYPE html>
<html>
<head>
	<script src="js/modernizr-latest.js"></script>
	<script src="js/jquery-1.9.1.js"></script>
	<title>Attendance</title>
	<style>
		* { margin:0; padding: 0; list-style-type: none; }
		body { line-height: 24px; font-size: 16px; }
		#fl_table { font-size: 1em }
		#fl_table a { font-size: .75em }
		#fl_table li .low { width: 3%; text-align: center }
		#fl_table li .hi { width: 15%; text-align: left }
		
		#fl_table li div { float: left; display: block; width: 9%; border-bottom: 1px dotted #999 }
		#fl_table li { clear: both; position: relative}
		#fl_table li:hover .del { display: block; position: absolute; left: 100%; width: 100px; margin-left: -100px; }
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
		
		#bottom {

		position: fixed;
		width: 20%;
		left: 70%;
		bottom: 30px;
		margin-bottom:-30px;
		}
		
		#bottom.over {
		background: url(pictures/empty_recycle_bin.png) right no-repeat;
		}
	</style>
	<script>
	function validateForm(){
		var lastholiday = document.myForm.lastholiday.value;
		var fromlh = document.myForm.fromlh.value;
		var tolh = document.myForm.tolh.value;
		if (lastholiday != 0){
			if (fromlh == 0){
				alert("Tanggal mulai cuti harus diisi.");
				return false;
			}
			if (tolh ==0 ){
				alert("Tanggal selesai cuti harus diisi.");
				return false;
			}
			if (fromlh >= tolh){
				alert("Tanggal selesai cuti harus lebih besar.");
				return false;
				}
			}
		if (fromlh != 0){
			if (lastholiday == 0){
				alert("Jumlah cuti harus diisi.");
				return false;
			}
			if (tolh == 0){
				alert("Tanggal selesai cuti harus diisi.");
				return false;
			}
		}
		if (tolh != 0){
			if (lastholiday == 0){
				alert("Jumlah cuti harus diisi.");
				return false;
			}
			if (fromlh == 0){
				alert("Tanggal mulai cuti harus diisi.");
				return false;
			}
		}
	}
	function allowDrop(ev)
	{
	ev.preventDefault();
	}
	function drag(ev)
	{
	ev.dataTransfer.effectAllowed='move';
	ev.dataTransfer.setData("Text",ev.target.id);
	}
	function drop(ev)
	{
		ev.preventDefault();
		var id=ev.dataTransfer.getData("Text");
		ev.target.appendChild(document.getElementById(id));
		
		$url = "attendance/attLogDelete.php";
		
		$.ajax({
			type: "POST",
			url: "attLogDelete.php",
			data: {"id": id},
			dataType: "text",
			success:function(data) {
				if(data) {
					alert("Log has been deleted");
				} else {
					alert("Delete fail, please try again");
				}}
		});	
/*						
			$.post($url, { id: data }, function(data) {
				alert("Masuk");
				alert("Success: " + data);
			});
			*/
	}
	</script>
</head>
<body>
	<?php
		require_once 'meekrodb.2.1.class.php';	
		$id = $_GET['id'];
		$row = DB::queryFirstRow("SELECT * FROM employees WHERE id=%s", $id);
		$results = DB::query("SELECT * FROM attlog WHERE employee=%s ORDER BY leaved DESC" , $id);
		$first = new DateTime($row['firstday']);
		$now = new DateTime();
		$interval = $now->diff($first);
		//$count = fmod($interval->y, 3);
		$cuti = 0;
		if($interval->y > 0){
			if ($interval->y > 2){
				$cuti = 36;
			} else {
				$cuti = $interval->y * 12;
			}
		}
		$masakerja = floor($interval->y);
	?>
    <ul id='fl_table'>
	<form name="myForm" action="attendanceU.php" method="post" onsubmit="return validateForm()">
		<input type="hidden" name="id" value="<?= $id ?>">
		<li>
		<label>Name: </label> 
		<input type="text" name="name" pattern="[A-Za-z ]*" value="<?= $row['name']  ?>" required>
		<br>
		<label>Birthplace: </label>
		<input type="text" name="birthplace" pattern="[A-Za-z ]*" value="<?= $row['birthplace']  ?>">
		<br>
		<label>Birthday: </label>
		<input type="date" name="birthday" value="<?= $row['birthday']  ?>">
		<br>
		<label>Company: </label>
		<select name="company">
		<option value=1 <?php if ($row['company'] == 1) echo 'selected' ?>>PT. Fajar Lintasirja Lines</option>
		<option value=2 <?php if ($row['company'] == 2) echo 'selected' ?>>PT. PBM. Bepondi Irja</option>
		<option value=3 <?php if ($row['company'] == 3) echo 'selected' ?>>PT. EMKL. Bewani Irja</option>
		<option value=4 <?php if ($row['company'] == 4) echo 'selected' ?>>PT. Bumi Wundi Irja</option>
		<option value=5 <?php if ($row['company'] == 5) echo 'selected' ?>>PT. Gasirja Utama</option>
		<option value=6 <?php if ($row['company'] == 6) echo 'selected' ?>>PT. Fajarirja Raya Mas</option>
		<option value=7 <?php if ($row['company'] == 7) echo 'selected' ?>>CV. Manisaprop</option>
		<option value=8 <?php if ($row['company'] == 8) echo 'selected' ?>>SPBU 84.981.01</option>
		<option value=9 <?php if ($row['company'] == 9) echo 'selected' ?>>APMS 84.981.01</option>
		</select>
		<br>
		<label>Firstday: </label>
		<input type="date" name="firstday" value="<?= $row['firstday']  ?>" required>
		<br>
		<label>Lastday: </label>
		<input type="date" name="lastday" value="<?= $row['lastday']  ?>">
		<br>
		<!--label>Leave: </label>
		<input type="number" name="lastholiday" value="<?= $row['lastholiday']  ?>" cols="2" step="1" min="0">
		<input type="date" name="fromlh" value="<?= $row['fromlh'] ?>"> to 
		<input type="date" name="tolh" value="<?= $row['tolh']  ?>" >
		<br-->

		
		<!--?php
			$from = new DateTime($row['fromlh']);
			$intervala = $from->diff($first);
			$masalibur = floor($intervala->y /3); 
			//echo $masalibur . "_" ;
			$masakerja = floor($interval->y /3);
			//echo $masakerja . "_";
			$counta = fmod($intervala->y, 3);
			if($masalibur == $masakerja){
				echo $cuti - $row['lastholiday'];
			} else {
				echo $cuti;
			}
		?-->
		
		<br>
		<label>&nbsp; </label><input class="button" name="submit" type="submit" value="Submit">
		</li>
	</form>
    </ul>
	<br>
	<?php
		echo "<ul id='fl_table'>";
		$no = 1;
		$re = null;
		echo"<li><div class=low>No</div>
		<div>Reason</div>
		<div class=low>Day</div>
		<div>Leave</div>
		<div>Return</div>
		<div class=low>Note</div></li>";
		foreach ($results as $rows){
			if ($rows['reason'] == 1){
				$re = "Sick";
			} else if ($rows['reason'] == 2){
				$re = "No call no show";
			} else if ($rows['reason'] == 3){
				$re = "Leave";
			} else {
				$re = $rows['reason'];	
			}
			echo "<li class='drag' draggable='true' id=".$rows['id']." ondragstart=drag(event)>".
			"<div class=low>" . $no  . "</div>".
			"<div><a href=attlogUpdate.php?id=".$rows['id'].">" . $re.	"</a></div>".				
			"<div class=low>" . $rows['day'] . "</div>".			
			"<div>" . $rows['leaved'] . "</div>".
			"<div>" . $rows['returnd'] . "</div></li>";
			$no++;
			$leaved = new DateTime($rows['leaved']);
			$intervala = $leaved->diff($first);
			$masalibur = floor($intervala->y); 
			//echo $masakerja ."-". $masalibur ."-".;
			if($masakerja < 3){
				$cuti = $cuti - $rows['day'];
				echo $cuti;
			} else if($masalibur >= ($masakerja - 3)){
				$cuti = $cuti - $rows['day'];
				echo $cuti;
			} else {
				echo 0;
			}			
		}
		echo "</ul>";
		
	?>
		<label>Available Leave: </label>
		<input type="text" name="holiday" value="<?= $cuti ?>" readonly>
	<li id="bottom">
	<img src="pictures/cart.png" id="cart" ondrop="drop(event)" ondragover="allowDrop(event)">
	<a href=attlogCreate.php?id=<?= $row['id'] ?>><img src="pictures/add1.png"></a>
	<a href=attendanceRead.php?id=<?= $row['id'] ?>><img src="pictures/user_group.png"></a>
	</li>

</body>
</html>