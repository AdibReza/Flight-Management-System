<?php
$activePage = 'passenger_details'; // Set this variable for each page
include 'topbar.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Flight Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #343a40; /* Dark background color */
            color: white; /* White text color */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Booking Details</h1>
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "flight";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM bookings";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr><th>Booking ID</th><th>Name</th><th>NID</th><th>Email</th><th>Origin</th><th>Destination</th><th>Booking Date</th><th>Arrival Date</th><th>Flight ID</th><th>Price</th></tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['booking_id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['NID'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['origin'] . '</td>';
            echo '<td>' . $row['destination'] . '</td>';
            echo '<td>' . $row['booking_date'] . '</td>';
            echo '<td>' . $row['arrival_date'] . '</td>';
            echo '<td>' . $row['flight_id'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No records found.';
    }

    mysqli_close($conn);
    ?>
</body>
</html>
