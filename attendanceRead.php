<!DOCTYPE html>
<html class="no-js">
<head>
	<script src="js/modernizr-latest.js"></script>
	<script src="js/jquery-1.9.1.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Attendance</title>
	<style>
		* { margin:0; padding: 0; list-style-type: none; }
		body { line-height: 24px; font-size: 16px; }
		#fl_table { font-size: 1em }
		#fl_table a { font-size: .9em }
		#fl_table li .low { width: 3%; text-align: center }
		#fl_table li .hi { width: 15%; text-align: left }
		
		#fl_table li div { float: left; display: block; width: 9%; border-bottom: 1px dotted #999 }
		#fl_table li { clear: both; position: relative}
		#fl_table li:hover .del { display: block; position: absolute; left: 100%; width: 100px; margin-left: -100px; }
		
		#bottom {
		position: fixed;
		width: 20%;
		left: 70%;
		bottom: 30px;
		margin-bottom:-30px;
		}
		
		#bottom.over {
		background: url(pictures/full_recycle_bin.png) right no-repeat;
		background: url(pictures/empty_recycle_bin.png) right no-repeat;
		}
		
		.drag {
		  -moz-user-select: none;
		  -khtml-user-select: none;
		  -webkit-user-select: none;
		  user-select: none;
		  -khtml-user-drag: element;
		  -webkit-user-drag: element;
		}
		
		#drop {
		  min-height: 100px;
		  width: 200px;
		  border: 3px dashed #ccc;
		  margin: 10px;
		  padding: 10px;
		  clear: left;
		}		

	</style>
	<script type="text/javascript">
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
			
			$url = "attendance/attendanceDelete.php";
			
			$.ajax({
				type: "POST",
				url: "attendanceDelete.php",
				data: {"id": id},
				dataType: "text",
				success:function(data) {
					if(data) {
						alert("Employee has been deleted");
					} else {
						alert("Delete fail, please try again");
					}}
			});	
			/*
			$.get('attendance/attendanceDelete.php?id='+data, function(data) {
				alert("Success: " + data);
			});
						
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
		$timezone = date_default_timezone_set('Asia/Tokyo');
		
		require_once 'meekrodb.2.1.class.php';
		$results = DB::query("SELECT id, name, coname, firstday, holiday, lastholiday, fromlh, tolh FROM employees, companies WHERE employees.company = companies.cocode");
		echo "<ul id='fl_table'>";
		foreach ($results as $row){
		
			$first = new DateTime($row['firstday']);
			$from = new DateTime($row['fromlh']);
			$now = new DateTime();
			
			$interval = $now->diff($first);
			$masakerja = floor($interval->y /3);
			$count = fmod($interval->y, 3);
			$cuti = 0;
			if($interval->y > 0){
				if ($count > 0){
					$cuti = $count * 12;
				} else {
					$cuti = 36;
				}
			}
			
			$intervala = $from->diff($first);
			$masalibur = floor($intervala->y / 3); 
			if($masalibur == $masakerja){
				$cuti = $cuti - $row['lastholiday'];
			}
			
			echo "<li class='drag' draggable='true' id=".$row['id']." ondragstart=drag(event)>".
			"<div class=hi>" . $row['coname'] . "</div>".
			"<div class=hi><a href=attendanceUpdate.php?id=".$row['id'].">" . $row['name'] . "</a></div>".
			
			"<div>" . $row['firstday']  . "</div>";				
			//"<div class=low>" . $cuti . "</div>".			
			//"<div>" . $row['fromlh'] . "</div>".
			//"<div>" . $row['tolh'] . "</div>".
			//"<div class=low><a href=attendanceUpdate.php?id=".$row['id'].">" . edit. "</a></div>";

			echo "</div></li>";
		} 
		echo "</ul>";
		
	?>
	<li id="bottom">
	<img src="pictures/cart.png" ondrop="drop(event)" ondragover="allowDrop(event)">
	<a href=attendanceCreate.php><img src="pictures/add_user.png"></a>
	</li>
	<!--div id="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></div-->

</body>
</html>
