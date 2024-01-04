<?php
 
    $Name = $_POST['Name']; // Match the form field name
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone']; // Match the form field name
    $id = $_POST['id']; // Match the form field name
    $pass = $_POST['pass']; // Match the form field name

    // Connecting with the database
    $conn = new mysqli('localhost', 'root', '', 'flight');
    if ($conn->connect_error) {
        die('Connection Failed. Error: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO register (name, email, phone, user_id, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $Name, $Email, $Phone, $id, $pass);
        if ($stmt->execute()) {
            // echo "Registration successful!";
            header("Location: login.php?error=Incorrect User name or password");
        } 
        $stmt->close();
        $conn->close();
    }

?>
