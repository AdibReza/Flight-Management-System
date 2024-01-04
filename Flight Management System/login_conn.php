<?php

$conn = mysqli_connect("localhost", "root", "", "flight");

if (!$conn) {
	echo "Connection failed!";
}