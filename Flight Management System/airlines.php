<?php
 
    $airlines = $_POST['airlines']; // Match the form field name
    $contact = $_POST['contact']; // Match the form field name
    

    // Connecting with the database
    $conn = new mysqli('localhost', 'root', '', 'flight');
    if ($conn->connect_error) {
        die('Connection Failed. Error: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO airlines ( airline_name , contact_no) VALUES (?, ?)");
        $stmt->bind_param("ss", $airlines, $contact);
        if ($stmt->execute()) {
            echo "New Airlines has been added!";
        } 
        $stmt->close();
        $conn->close();
    }

?>
