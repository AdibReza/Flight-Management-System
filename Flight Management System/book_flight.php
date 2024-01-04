<?php
$activePage = 'book_flight'; // Set this variable for each page
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
            padding: 0;
        }
        .container {
            margin-top: 70px;
            width: 80%;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            background-color: white;
            border-radius: 10px;
        }
        .card-header {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 8px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
            max-width: 535px; /* Adjust the width as needed */
        }
        .btn-primary {
            background-color: #343a40;
            border: none;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            width: 100%;
            max-width: 150px; /* Adjust the width as needed */
            margin: 0 auto;
            display: block;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #292d30;
        }
        h2.display-6 {
            margin-top: 0;
        }
    </style>
    <title>Book Flight</title>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="display-6">Book Your Flight</h2>
                    </div>
                    <div class="card-body">
                        <?php
                            if(isset($_GET['flight_id'])) {
                                $flight_id = $_GET['flight_id'];

                                // Database connection
                                require_once('search_flight_con.php');

                                // Fetch flight details by flight_id
                                $stmt = mysqli_prepare($con, "SELECT * FROM flights_origin_destination WHERE flight_id = ?");
                                mysqli_stmt_bind_param($stmt, "s", $flight_id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo "<p><strong>Flight Name:</strong> " . htmlspecialchars($row['flight_name']) . "</p>";
                                    echo "<p><strong>Origin:</strong> " . htmlspecialchars($row['origin']) . "</p>";
                                    echo "<p><strong>Destination:</strong> " . htmlspecialchars($row['destination']) . "</p>";
                                    echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
                                    echo "<p><strong>Price:</strong> $" . htmlspecialchars($row['price']) . "</p>";
                                    // Display booking form
                                    echo '<form method="post" action="submit_booking.php">';
                                    echo '<input type="hidden" name="flight_id" value="' . $flight_id . '">';
                                    echo '<div class="form-group"><input type="text" class="form-control" name="name" placeholder="Name" required></div>';
                                    echo '<div class="form-group"><input type="email" class="form-control" name="email" placeholder="Email" required></div>';
                                    echo '<div class="form-group"><input type="text" class="form-control" name="NID" placeholder="NID" required></div>';
                                    echo '<div class="form-group"><label><strong>Confirm arrival date</strong></label><input type="date" class="form-control" name="arrival_date" placeholder="arrival_date"></div>';
                                    echo '<div class="form-group"><label><strong>Travelers: </label><<input type="number" class="form-control" name="travelers" placeholder="travelers" ></div>';
                                    echo '<div class="form-group">
                                            <label for="class_selection"><strong>Select Class:</strong></label>
                                            <select class="form-control" name="class" id="class" required>
                                                <option value="" disabled selected>Select a class</option>
                                                <option value="Economy">Economy Class</option>
                                                <option value="Business">Business Class</option>
                                            </select>
                                        </div>
                                        ';
                                    echo '<div class="form-group">
                                            <label for="food_name"><strong>Select Food:</strong></label>
                                            <select class="form-control" name="food_name" id="food_name" >
                                                <option value="" disabled selected>Select a food</option>
                                                <option value="vegetarian">Vegetarian</option>
                                                <option value="non vegetarian">Non-Vegetarian</option>
                                                <option value="none">None</option>
                                            </select>
                                        </div>
                                        ';


                                    echo '<button type="submit" class="btn btn-primary btn-block">Book Now</button>';
                                    echo '</form>';
                                } else {
                                    echo "<p>Flight details not found.</p>";
                                }
                            } else {
                                echo "<p>No flight selected.</p>";
                            }

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
