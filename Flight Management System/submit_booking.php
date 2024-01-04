<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['flight_id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['NID']) && isset($_POST['arrival_date']) && isset($_POST['travelers']) && isset($_POST['class']) && isset($_POST['food_name'])) {
        
        // Assign POST data to variables
        $flight_id = $_POST['flight_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $NID = $_POST['NID'];
        $arrival_date = $_POST['arrival_date'];
        $travelers = $_POST['travelers'];
        $class = $_POST['class'];
        $food_name = $_POST['food_name'];
        
        // Database connection
        require_once('search_flight_con.php');

        // Fetch flight details from selected flight_id
        $stmt_flight = mysqli_prepare($con, "SELECT origin, destination, price, date FROM flights_origin_destination WHERE flight_id = ?");
        mysqli_stmt_bind_param($stmt_flight, "s", $flight_id);
        mysqli_stmt_execute($stmt_flight);
        $result_flight = mysqli_stmt_get_result($stmt_flight);

        if (mysqli_num_rows($result_flight) > 0) {
            $row_flight = mysqli_fetch_assoc($result_flight);
            $origin = $row_flight['origin'];
            $destination = $row_flight['destination'];
            $price = $row_flight['price'];
            $date = $row_flight['date'];

            // Fetch food price
            $stmt_food = mysqli_prepare($con, "SELECT price FROM food WHERE food_name = ?");
            mysqli_stmt_bind_param($stmt_food, "s", $food_name);
            mysqli_stmt_execute($stmt_food);
            $result_food = mysqli_stmt_get_result($stmt_food);

            if (mysqli_num_rows($result_food) > 0) {
                $row_food = mysqli_fetch_assoc($result_food);
                $food_price = $row_food['price'];

                // Fetch class fare
                $stmt_class = mysqli_prepare($con, "SELECT fare FROM class WHERE class_type = ?");
                mysqli_stmt_bind_param($stmt_class, "s", $class);
                mysqli_stmt_execute($stmt_class);
                $result_class = mysqli_stmt_get_result($stmt_class);

                if (mysqli_num_rows($result_class) > 0) {
                    $row_class = mysqli_fetch_assoc($result_class);
                    $class_price = $row_class['fare'];

                    // Calculate total amount
                    $total_amount = ($class_price + $price + $food_price) * $travelers;

                    // Insert booking details into the database
                    $insert_booking_stmt = mysqli_prepare($con, "INSERT INTO bookings (flight_id, name, email, NID, origin, destination, price, booking_date, arrival_date, travelers, class, food_name, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    mysqli_stmt_bind_param($insert_booking_stmt, "ssssssississi", $flight_id, $name, $email, $NID, $origin, $destination, $price, $date, $arrival_date, $travelers, $class, $food_name, $total_amount);

                    $insert_billing_stmt = mysqli_prepare($con, "INSERT INTO billing (NID, name, email, food_price, travellers, class, class_price, flight_price, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    mysqli_stmt_bind_param($insert_billing_stmt, "issiisiii", $NID, $name, $email, $food_price, $travelers, $class, $class_price, $price, $total_amount);

                    if (mysqli_stmt_execute($insert_booking_stmt) && mysqli_stmt_execute($insert_billing_stmt)) {
                        mysqli_stmt_close($insert_booking_stmt);
                        mysqli_stmt_close($insert_billing_stmt);
                        mysqli_close($con);

                        // Redirect to billing page with email parameter
                        header("Location: billing_page.php?email=$email");
                        exit;
                    } else {
                        echo "<p>Booking failed. Please try again later.</p>";
                    }

                } else {
                    echo "<p>Class details not found.</p>";
                }
            } else {
                echo "<p>Food details not found.</p>";
            }
        } else {
            echo "<p>Flight details not found.</p>";
        }
    } else {
        echo "<p>Invalid data submitted.</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
