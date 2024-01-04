<?php
$activePage = 'billing_page'; // Set this variable for each page
include 'topbar_passenger.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Billing Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 80px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        .download-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .download-button:hover {
            background-color: #2980b9;
        }

        .button-container {
            text-align: right;
            margin-top: 20px;
        }
    </style>

</head>
<body>
    <div class="container">
        <h1>Your Billing Details</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Flight Price</th>
                <th>Food Price</th>
                <th>Travelers</th>
                <th>Class Price</th>
                <th>Total Amount</th>
            </tr>
            <?php
            // Database connection setup (replace with your database connection code)
            $con = mysqli_connect("localhost", "root", "", "flight");
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            // Fetch billing details using email from booking data
            if (isset($_GET['email'])) {
                $email = $_GET['email'];
                $billing_query = "SELECT name, email, flight_price, food_price, travellers, class, class_price, total FROM billing WHERE email = ?";
                $billing_stmt = mysqli_prepare($con, $billing_query);
                mysqli_stmt_bind_param($billing_stmt, "s", $email);

                mysqli_stmt_execute($billing_stmt);
                $billing_result = mysqli_stmt_get_result($billing_stmt);

                if ($billing_result) {
                    while ($row = mysqli_fetch_assoc($billing_result)) {
                        echo "<tr>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['flight_price']}</td>";
                        echo "<td>{$row['food_price']}</td>";
                        echo "<td>{$row['travellers']}</td>";
                        echo "<td>{$row['class_price']}</td>";
                        echo "<td>{$row['total']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No billing data found for the provided email.</td></tr>";
                }

                mysqli_stmt_close($billing_stmt);
            } else {
                echo "<tr><td colspan='7'>Invalid email provided.</td></tr>";
            }

            mysqli_close($con);
            ?>
        </table>
        <tr>
        <td colspan="7" style="text-align: center;">
            <form action="generate_invoice.php" method="post">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <a href="generate_invoice.php?email=<?php echo urlencode($email); ?>" class="download-button">Download Invoice</a>
            </form>
        </td>
    </tr>
    </div>
</body>
</html>
