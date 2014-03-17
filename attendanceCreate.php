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
		#fl_table a { font-size: .75em }
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
	</style>
</head>
<body>
    <ul id='fl_table'>
	<form action="attendanceC.php" method="post">
		<li>
		<label>Name: </label> 
		<input type="text" name="name" pattern="[A-Za-z ]*" required>
		<br>
		<label>Birthplace: </label>
		<input type="text" name="birthplace" pattern="[A-Za-z ]*">
		<br>
		<label>Birthday: </label>
		<input type="date" name="birthday">
		<br>
		<label>Company: </label>
		<select name="company">
		<option value=1>PT. Fajar Lintasirja Lines</option>
		<option value=2>PT. PBM. Bepondi Irja</option>
		<option value=3>PT. EMKL. Bewani Irja</option>
		<option value=4>PT. Bumi Wundi Irja</option>
		<option value=5>PT. Gasirja Utama</option>
		<option value=6>PT. Fajarirja Raya Mas</option>
		<option value=7>CV. Manisaprop</option>
		<option value=8>SPBU 84.981.01</option>
		<option value=9>APMS 84.981.01</option>
		</select>
		<br>
		<label>Firstday: </label>
		<input type="date" name="firstday">
		<br>
		<label>Lastday: </label>
		<input type="date" name="lastday">
		<br>
		<label>Holiday: </label>
		<input type="number" name="holiday" cols="2" step="1" min="0" max="36">
		<br>
		<label>Last Holiday: </label>
		<input type="date" name="fromlh"> to 
		<input type="date" name="tolh"><br>
		<br>
		<label>&nbsp; </label><input class="button" name="submit" type="submit" value="Submit">
		</li>
	</form>
    </ul>
	<li id="bottom">
	<a href=attendanceRead.php><img src="pictures/user_group.png"></a>
	</li>

</body>
</html>
