<?php
// Database connection setup
$host = "localhost";
$username = "root";
$password = "";
$database = "flight";

$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["checkFlights"])) {
    $origin = $_POST["from"];
    $destination = $_POST["to"];
    $departureDate = $_POST["departure"];

    // Construct the query
    $query = "SELECT * FROM flights WHERE origin = '$origin' AND destination = '$destination' AND departure_date = '$departureDate'";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Process results
    $flightData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $flightData[] = $row;
    }

    // Send response to client as JSON
    echo json_encode($flightData);
}

// Close the database connection
mysqli_close($connection);
?>
