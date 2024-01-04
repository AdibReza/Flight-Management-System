<?php 
	$con = mysqli_connect("localhost", "root", "", "flight");

	if (!$con){
		die("Connection error: " . mysqli_connect_error());
	}
?>
