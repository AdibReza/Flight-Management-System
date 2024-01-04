<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Bar Navigation</title>
    <style>
        /* Your navigation bar styles here */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .topbar {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            display: flex; /* Use flexbox to align items */
            justify-content: flex-start; /* Align items to the left */
            align-items: center; /* Center items vertically */
        }
        .topbar a {
            display: inline-block;
            background-color: #333;
            color: white;
            text-decoration: none;
            padding: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }
        .topbar a.selected {
            background-color: #555; /* Different color for selected link */
        }
        .topbar a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <a href="home.html">Home</a> <!-- Added "Home" button -->
        <a href="admin_booking.php" <?php if ($activePage === 'admin_booking') echo 'class="selected"'; ?>>Add Flight</a>
        <a href="flight_details.php" <?php if ($activePage === 'flight_details') echo 'class="selected"'; ?>>Flight Details</a>
        <a href="passenger_details.php" <?php if ($activePage === 'passenger_details') echo 'class="selected"'; ?>>Bookings</a>
        <a href="billing_details.php" <?php if ($activePage === 'billing_details') echo 'class="selected"'; ?>>Billings</a>

        <!-- Add more links if needed -->
    </div>
</body>
</html>
