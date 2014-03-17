<!DOCTYPE html>
<html>
<head>
	<script src="js/modernizr-latest.js"></script>
	<script src="js/jquery-1.9.1.js"></script>
	<meta http-equiv="refresh" content="0;url=attendanceRead.php" />
	<title>Lawari Empire</title>
</head>
<body> 
<?php
	require_once 'meekrodb.2.1.class.php';
	$id = $_POST['id'];
	$name = $_POST['name'];
	$birthplace = $_POST['birthplace'];	
	$birthday = $_POST['birthday'];
	$company = $_POST['company'];
	$firstday = $_POST['firstday'];	
	$lastday = $_POST['lastday'];	
	$holiday = $_POST['holiday'];
	$lastholiday = $_POST['lastholiday'];	
	$fromlh = $_POST['fromlh'];	
	$tolh = $_POST['tolh'];
	DB::update('employees', array(
		'name' => $name,
		'birthplace' => $birthplace,
		'birthday' => $birthday,
		'company' => $company,
		'firstday' => $firstday,
		'lastday' => $lastday,
		'holiday' => $holiday,
		'lastholiday' => $lastholiday,
		'fromlh' => $fromlh,
		'tolh' => $tolh,
	), "id=%s", $id);
?>

</body>
</html>