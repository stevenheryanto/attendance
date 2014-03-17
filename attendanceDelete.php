<!DOCTYPE html>
<html>
<head>

<meta http-equiv="refresh" content="0;url=attendanceRead2.php" />
<title>Biakcom</title>
<a href="attendanceRead2.php">redirecting...</a>
</head>
<body>
	<?php 
		require_once 'meekrodb.2.1.class.php';
		$id = $_POST['id'];
		//$id = $_GET['id'];
		DB::delete('employees', "id=%s", $id);
	?>
</body>
</html>
