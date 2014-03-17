<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Impor aja</title>
</head>
<body> 
<?php
	//echo "A";
	define('CSV_PATH','attendance.s.dibiak.net/');
	//echo "B";
	$csv_file = "jreng.csv"; 
	//echo $csv_file;
	$csvfile = fopen($csv_file, 'r');
	//$theData = fgets($csvfile);
	/*if($csvfile == null){
		echo "null<br>";
	} else {
		echo "ada kok<br>";
	}
	*/
	$i = 0;
	
	while(!feof($csvfile)) {
		$csv_data[] = fgets($csvfile);
		$csv_array = explode(";", $csv_data[$i]);
		$id =$csv_array[0];
		$date =$csv_array[1];
		$unit =$csv_array[2];
		$status =$csv_array[3];
		$hari = substr($date,0,10);
		$jam = substr($date,11,4);
		echo $id ."-".$status."-".$jam."-".$hari."<br>";
		$i++;
		//echo $id."<br>";
	}
	
	echo "---" ;
	fclose($csvfile);
?>
</body>
</html>l>