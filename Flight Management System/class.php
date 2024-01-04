<?php
 
    $class = $_POST['class']; // Match the form field name
    $fare = $_POST['fare']; // Match the form field name
    

    // Connecting with the database
    $conn = new mysqli('localhost', 'root', '', 'flight');
    if ($conn->connect_error) {
        die('Connection Failed. Error: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO class ( class_type , fare) VALUES (?, ?)");
        $stmt->bind_param("ss", $class, $fare);
        if ($stmt->execute()) {
            echo "Class has been added!";
        } 
        $stmt->close();
        $conn->close();
    }

?>
