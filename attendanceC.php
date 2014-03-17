<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="0;url=attendanceCreate.php" />
	<title>Attendance</title>
</head>
<body> 
<?php
	require_once 'meekrodb.2.1.class.php';	
	$name = $_POST['name'];
	$birthplace = $_POST['birthplace'];	
	$birthday = $_POST['birthday'];
	$company = $_POST['company'];
	$firstday = $_POST['firstday'];	
	$lastday = $_POST['lastday'];	
	$holiday = $_POST['holiday'];	
	$fromlh = $_POST['fromlh'];	
	$tolh = $_POST['tolh'];
	DB::insert('employees', array(
		'name' => $name,
		'birthplace' => $birthplace,
		'birthday' => $birthday,
		'company' => $company,
		'firstday' => $firstday,
		'lastday' => $lastday,
		'holiday' => $holiday,
		'fromlh' => $fromlh,
		'tolh' => $tolh,
	));
?>

</body>
</html>