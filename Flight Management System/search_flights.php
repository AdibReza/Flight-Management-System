<?php
$activePage = 'search_flights'; // Set this variable for each page
include 'topbar_passenger.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .container {
            border-radius: 10px; /* Add rounded corners */
            overflow: hidden; /* Clip content within the rounded corners */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            width: 80%; /* Adjust the width */
            max-width: 1200px; /* Set a maximum width */
            margin: 70px auto 0; /* Center horizontally and shift from the top */
        }
        .card {
            border: none;
        }
        .card-header {
            background-color: #343a40;
            padding: 12px;
            color: white;
            text-align: center;
        }
        .card-body {
            padding: 20px;
            overflow-y: auto; /* Add vertical scroll for the card body content */
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        .book-button {
            display: inline-block;
            padding: 8px 15px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .book-button:hover {
            background-color: #0056b3;
        }
    </style>
    <title>View Records</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2 class="display-6">Select Your Desired Flight</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if(isset($_GET['from']) && isset($_GET['to']) && isset($_GET['departure'])) {
                                $from = $_GET['from'];
                                $to = $_GET['to'];
                                $departure = $_GET['departure'];
                                                    

                                // Database connection
                                require_once('search_flight_con.php');

                                // Using prepared statements for security
                                $stmt = mysqli_prepare($con, "SELECT * FROM flights_origin_destination WHERE origin = ? AND destination = ? AND date = ?");
                                mysqli_stmt_bind_param($stmt, "sss", $from, $to, $departure);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if (!$result) {
                                    echo "Query error: " . mysqli_error($con);
                                } else {

                                    if (mysqli_num_rows($result) > 0) {
                                        echo "<table>";
                                        echo "<tr><th>Flight Name</th><th>Origin</th><th>Destination</th><th>Date</th><th>Price</th></tr>";
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['flight_name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['origin']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['destination']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                                            echo '<td><a href="book_flight.php?flight_id=' . $row['flight_id'] . '"class="book-button">Book</a></td>';                                           
                                            echo "</tr>";
                                        }

                                        echo "</table>";
                                    } else {
                                        echo "<p>No flights available for the selected route.</p>";
                                    }
                                }
                            } else {
                                echo "<p>No data provided.</p>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
