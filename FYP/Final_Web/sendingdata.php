<?php 
	//Connection to database
	$to_connect = mysqli_connect("localhost", "root", "", "project_10_length");
	
	//Read data from nodemcu
	$svalue = $_GET["sensor"];
	//$svalue = -20;
	$query = "SELECT * FROM signal_length WHERE $svalue between starting_range and ending_range";
	$result_set = mysqli_query($to_connect, $query);
	$rows = mysqli_fetch_assoc($result_set);
	$signal_status = $rows['signal_status'];
	
	//Update data to database (in table valuereading)
	mysqli_query($to_connect, "INSERT INTO signal_value (signal_val,status,time_updated) VALUES ('$svalue','$signal_status',NOW())");
?>
