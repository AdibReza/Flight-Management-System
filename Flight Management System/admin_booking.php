<?php
$activePage = 'admin_booking'; // Set this variable for each page
include 'topbar.php';

// Initialize variables to hold the success message
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $origin = $_POST['origin'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $flight_name = $_POST['flight_name'];
    $price = $_POST['price'];
    $flight_id = $_POST['flight_id'];

    // Connecting with the database
    $conn = new mysqli('localhost', 'root', '', 'flight');
    if ($conn->connect_error) {
        die('Connection Failed. Error: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO flights_origin_destination (origin, destination, date, flight_name, flight_id, price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $origin, $destination, $date, $flight_name, $flight_id, $price);
        if ($stmt->execute()) {
            $successMessage = "Flight Added Successfully!!!"; // Set success message
        }
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Insertion Form</title>
    <link rel="stylesheet" href="notunpagecss.css">
</head>
<body>
    <section class="prothom">
        <div class="container">
            <form class="form-group" action="admin_booking.php" method="post">
                <h1 class="text-center">Flight Insertion(Manager)</h1>
                <!-- Display success message if applicable -->

                <div class="form-section">
                    <h3 class="section-title">Flight Details</h3>

                    <div class="input-group">
                        <label for="origin" class="input-label">Origin:</label>
                        <input type="text" id="origin" class="input-field" placeholder="Origin" name="origin">

                    </div>

                    <div class="input-group">
                        <label for="destination" class="input-label">Destination:</label>
                        <input type="text" id="destination" class="input-field" placeholder="Destination" name="destination">
                    </div>

                    <div class="input-group">
                        <label for="date" class="input-label">Date:</label>
                        <input type="date" id="date" class="input-field" name="date">
                    </div>

                    <div class="input-group">
                        <label for="flight_name" class="input-label">Flight Name:</label>
                        <input type="text" id="flight_name" class="input-field" placeholder="Flight Name" name="flight_name">
                    </div>

                    <div class="input-group">
                        <label for="price" class="input-label">Price:</label>
                        <input type="number" id="price" class="input-field" placeholder="Price" name="price">
                    </div>

                    <div class="input-group">
                        <label for="flight_id" class="input-label">Flight ID:</label>
                        <input type="text" id="flight_id" class="input-field" placeholder="Flight ID" name="flight_id">
                    </div>


                    <button type="submit" class="btn-submit">Submit</button>
                <?php if ($successMessage !== ''): ?>
                    <div class="success-message"><?php echo $successMessage; ?></div>
                <?php endif; ?>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
