<?php 
session_start(); 
include "login_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: login_html.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: login_html.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM register WHERE user_id='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if ( $uname === 'admin' &&  $pass==='0000') {
				$_SESSION['user_id'] = $row['user_id'];
            	$_SESSION['name'] = $row['name'];
				$_SESSION['email'] = $row['email'];
            	$_SESSION['phone'] = $row['phone'];
            	header("Location: admin_booking.php");
		        exit();


            } else if ($row['user_id'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_id'] = $row['user_id'];
            	$_SESSION['name'] = $row['name'];
				$_SESSION['email'] = $row['email'];
            	$_SESSION['phone'] = $row['phone'];
            	header("Location: booking_page.php");
		        exit();
            }else{
				header("Location: home.html?error=Incorrect User name or password");
		        exit();
			}
		}else{
			header("Location: home.html?error=Incorrect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: home.html");
	exit();
}