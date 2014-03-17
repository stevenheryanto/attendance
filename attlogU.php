<!DOCTYPE html>
<html>
<head>
<?php
	require_once 'meekrodb.2.1.class.php';	
	$id = $_POST['id'];
	$reason = $_POST['reason'];	
	if ($reason == "Other"){
		$reason = $_POST['other'];	
	}
	$day = $_POST['day'];	
	$leaved = $_POST['leaved'];	
	$returnd = $_POST['returnd'];
	DB::update('attlog', array(
		'reason' => $reason,
		'leaved' => $leaved,
		'returnd' => $returnd,
		'day' => $day,
	), "id=%s", $id);

?>
	<meta http-equiv="refresh" content="0;url=attendanceRead.php" />
	<title>Absence</title>
</head>
<body>
</body>
</html>