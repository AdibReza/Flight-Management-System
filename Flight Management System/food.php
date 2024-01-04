<?php
 
    $food = $_POST['food']; // Match the form field name
    $price = $_POST['price']; // Match the form field name
    

    // Connecting with the database
    $conn = new mysqli('localhost', 'root', '', 'flight');
    if ($conn->connect_error) {
        die('Connection Failed. Error: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO food (food_name , price) VALUES (?, ?)");
        $stmt->bind_param("ss", $food, $price);
        if ($stmt->execute()) {
            echo "Food has been added!";
        } 
        $stmt->close();
        $conn->close();
    }

?>
