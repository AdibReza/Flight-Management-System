<?php
if(isset($_GET['flight_id'])) {
    $flight_id = $_GET['flight_id'];

    // Connecting to the database
    $conn = new mysqli('localhost', 'root', '', 'flight');

    if ($conn->connect_error) {
        die('Connection Failed. Error: ' . $conn->connect_error);
    } else {
        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM flights_origin_destination WHERE flight_id = ?");
        $stmt->bind_param("s", $flight_id); // Assuming flight_id is an integer
        if ($stmt->execute()) {
            mysqli_close($conn);
            header("Location: flight_details.php");
            exit();
        } else {
            echo "Error deleting flight: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "Flight ID not provided.";
}
?>
