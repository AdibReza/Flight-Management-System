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
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            display: flex;
            justify-content: flex-start;
            align-items: center;
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
        /* Style for the "Home" link */
        .topbar .home-link:hover {
            background-color: #555;
        }
        .topbar a.selected {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <a href="home.html" class="home-link">Home</a>
        <a <?php if ($activePage === 'booking_page') echo 'class="selected"'; ?>>Search Flights</a>
        <a <?php if ($activePage === 'search_flights') echo 'class="selected"'; ?>>Available Flights</a>
        <a <?php if ($activePage === 'book_flight') echo 'class="selected"'; ?>>Booking</a>
        <a <?php if ($activePage === 'billing_page') echo 'class="selected"'; ?>>Billing</a>
    </div>
</body>
</html>
