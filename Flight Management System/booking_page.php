<?php
$activePage = 'booking_page'; // Set this variable for each page
include 'topbar_passenger.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Reservation</title>
    <style>
        body {
            background-image: url('ghibli_esky.jpg'); /* Replace with the actual image path */
            background-color: #f2f2f2;
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;        }
        .container {
            margin-top: 50px;
            width: 440px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            background-color: white;
            border-radius: 10px;
        }
        .card-header {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 12px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body {
            padding: 20px;
        }
        .form-row {
            margin-bottom: 15px; /* Add space between rows */
        }
        label {
            font-weight: bold;
            margin-right: 10px;
        }
        input, select {
            width: 94%; /* Adjust the width as needed */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        label, input[type="radio"] {
            display: inline-block;
        }
        button {
            background-color: #343a40;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #292d30;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="display-6">Flight Reservation System</h2>
            </div>
            <div class="card-body">
                <form action="search_flights.php" method="get">
                    <div class="form-row">
                        <label><input type="radio" name="tripType" value="oneway" checked> One-Way</label>
                        <label><input type="radio" name="tripType" value="roundtrip"> Round Trip</label>
                    </div>
                    <div class="form-row">
                        <label for="from">From:</label>
                        <input type="text" name="from" id="from" required>
                    </div>
                    
                    <div class="form-row">
                        <label for="to">To:</label>
                        <input type="text" name="to" id="to" required>
                    </div>
                    <div class="form-row">
                        <label for="departure">Departure:</label>
                        <input type="date" name="departure" id="departure" required>
                    </div>
                    <div class="form-row">
                        <label for="arrival">Arrival:</label>
                        <input type="date" name="arrival" id="arrival" disabled>
                    </div>
                    <button type="submit">Search Flights</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        const tripTypeRadio = document.querySelectorAll('input[name="tripType"]');
        const arrivalInput = document.getElementById('arrival');

        tripTypeRadio.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'roundtrip') {
                    arrivalInput.disabled = false;
                } else {
                    arrivalInput.disabled = true;
                }
            });
        });
    </script>
</body>
</html>
