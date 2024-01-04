<?php
 
    $origin = $_POST['origin']; // Match the form field name
    $dest= $_POST['dest']; // Match the form field name
    $depart = $_POST['depart'];
    $arr = $_POST['arr']; // Match the form field name
    $airlines = $_POST['airlines']; // Match the form field name
    $class = $_POST['class']; // Match the form field name
    $id = $_POST['id'];
    $food = $_POST['food'];
    $seat = $_POST['seat'];

    // Connecting with the database
    $conn = new mysqli('localhost', 'root', '', 'flight');
    if ($conn->connect_error) {
        die('Connection Failed. Error: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO booking (flight_name, departure, arrival, origin, destination, seat_no, user_id, class, food) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $airlines, $depart, $arr, $origin, $dest, $seat, $id, $class, $food);
        if ($stmt->execute()) {
            echo "Flight has been booked!";
        } 

        $stmt->close();
        $conn->close();
    }

?>
