<?php
// Mock seat map data with seat numbers
$seatMap = [
    ["A1", "A2", "0", "A3"],
    ["B1", "0", "B2", "B3"],
    ["0", "C1", "C2", "0"],
    ["D1", "D2", "D3", "D4"],
    ["0", "0", "E1", "E2"],
];


// Database connection parameters
$hostname = "localhost";
$username = "root";
$password = "";
$database = "flight";

// Establish a database connection
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Validate URL parameters and book the seat
if (isset($_GET['row']) && isset($_GET['seat']) && isset($_GET['passenger_name'])) {
    $row = $_GET['row'];
    $seat = $_GET['seat'];
    $passengerName = $_GET['passenger_name'];

    // Validate the row and seat values here
    if (is_numeric($row) && is_numeric($seat) && $row >= 0 && $seat >= 0 && $row < count($seatMap) && $seat < count($seatMap[$row])) {
        // Check if the seat is available
        if ($seatMap[$row][$seat] !== 0) {
            // Attempt to book the seat
            $bookingResult = bookSeat($row, $seat, $passengerName);

            // Display the appropriate message based on the booking result
            if ($bookingResult) {
                echo 'Seat ' . $seatMap[$row][$seat] . ' booked successfully by ' . $passengerName . '!';
            } else {
                echo 'Sorry, seat ' . $seatMap[$row][$seat] . ' is already booked.';
            }
        } else {
            echo 'Sorry, seat ' . $seatMap[$row][$seat] . ' is not available.';
        }
    } else {
        echo 'Invalid seat selection.';
    }
} else {
    echo 'Seat selection parameters not provided.';
}

// Function to book a seat
function bookSeat($row, $seat, $passengerName) {
    global $seatMap, $mysqli;

    // Check if the seat is available
    if ($seatMap[$row][$seat] !== "0") {
        // Attempt to book the seat
        $seatIdentifier = $seatMap[$row][$seat];
        $sql = "INSERT INTO seat_bookings (row, seat, passenger_name) VALUES ('$row', '$seatIdentifier', '$passengerName')";
        if ($mysqli->query($sql) === TRUE) {
            // Book the seat in the seat map
            $seatMap[$row][$seat] = "0";  // Mark the seat as booked
            return true;  // Seat successfully booked
        } else {
            return false; // An error occurred while booking the seat
        }
    } else {
        return false; // Seat is already booked
    }
}

?>
