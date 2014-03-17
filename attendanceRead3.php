<!DOCTYPE html>
<html class="no-js">
<head>
	<script src="js/modernizr-latest.js"></script>
	<script src="js/jquery-1.9.1.min.js"></script>
	<meta http-equiv="refresh" content="30;url=frontdeskRead.php" />
	<title>Lawari Empire</title>
</head>
<body>
	<?php
		$con=mysqli_connect("127.0.0.1:3306","adminfd","adminfd","frontdesk");

		if (mysqli_connect_errno($con)){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}		
		$view = mysqli_query($con, "SELECT * FROM log ORDER BY start DESC");
		
		echo "<table>
			<tr>
			<th>No</th>
			<th>Date</th>
			<th>Customer</th>
			<th>Product</th>
			<th>Service</th>
			<th>Notes</th>
			<th>Paid</th>
			<th>Taken</th>
			<th>Edit</th>
			</tr>
		";
		
		while($row = mysqli_fetch_array($view)){
			echo "<tr>";
			echo "<td>" . $row['query'] . "</td>";
			echo "<td>" . $row['start'] . "</td>";
			echo "<td>" . $row['customer'] . "</td>";
			
			$products = explode(",",$row['product']);
			echo "<td>"; 
			foreach ($products as $product){
				switch ($product){
				case 1:
					echo "Document. ";
					break;
				case 2:
					echo "Desktop / Laptop. ";
					break;
				case 3:
					echo "Monitor. ";
					break;
				case 4:
					echo "Printer / Scanner / Copier / Fax. ";	
					break;
				case 5:
					echo "Speaker / Microphone. ";
					break;
				case 6:
					echo "Adaptor / Battery / Charger. ";
					break;
				case 7:
					echo "Power Supply / UPS. ";
					break;
				case 8:
					echo "ISP. ";	
					break;
				}				
			}
			echo "</td>";
			//echo "<td>" . $row['product'] . "</td>";
			
			$services = explode(",",$row['service']);
			echo "<td>"; 
			foreach ($services as $service){
				switch ($service){
				case 1:
					echo "Type. ";
					break;
				case 2:
					echo "Print. ";
					break;
				case 3:
					echo "Jilid. ";
					break;
				case 4:
					echo "Install/repair/update OS. ";	
					break;
				case 5:
					echo "Install/update driver. ";
					break;
				case 6:
					echo "Install/update anti-virus. ";
					break;
				case 7:
					echo "Install application. ";
					break;
				case 8:
					echo "Replace cartridge. ";	
					break;
				case 9:
					echo "Maintenance / repair / part replacement. ";	
					break;
				}				
			}
			echo "</td>";
			//echo "<td>" . $row['service'] . "</td>";
			
			echo "<td>" . $row['notes'] . "</td>";
			echo "<td>" . $row['ispaid'] . "</td>";
			echo "<td>" . $row['istaken'] . "</td>";
			echo "<td><a href=frontdeskUpdate.php?id=".$row['idlog'].">" . edit. "</a></td>";
			echo "<td><a href=frontdeskDelete.php?id=".$row['idlog'].">" . delete. "</a></td>";
			echo "</tr>";
		} 
		echo "</table>";	
	?>
</body>
</html>
