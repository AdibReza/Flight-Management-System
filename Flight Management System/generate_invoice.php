<?php
require_once 'dompdf/autoload.inc.php'; // Adjust the path if necessary

use Dompdf\Dompdf;

// Database connection setup (replace with your database connection code)
$con = mysqli_connect("localhost", "root", "", "flight");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch billing and booking details using email
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $billing_query = "SELECT b.name, b.email, b.flight_price, b.food_price, b.travellers, b.class, b.class_price, b.total, bk.booking_date, bk.arrival_date, bk.origin, bk.destination, bk.class AS booking_class, bk.food_name, bk.flight_id 
                      FROM billing AS b
                      INNER JOIN bookings AS bk ON b.email = bk.email
                      WHERE b.email = ?";
    $billing_stmt = mysqli_prepare($con, $billing_query);
    mysqli_stmt_bind_param($billing_stmt, "s", $email);

    mysqli_stmt_execute($billing_stmt);
    $billing_result = mysqli_stmt_get_result($billing_stmt);

    if ($billing_result) {
        $row = mysqli_fetch_assoc($billing_result);

        // Create HTML content for the PDF
        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                .invoice {
                    width: 100%;
                    max-width: 800px;
                    margin: 0 auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    background-color: #fff;
                }
                .invoice-header {
                    text-align: center;
                }
                .invoice-header h1 {
                    margin: 0;
                    font-size: 24px;
                }
                .invoice-details {
                    margin-top: 20px;
                }
                .invoice-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                .invoice-table th, .invoice-table td {
                    border: 1px solid #ccc;
                    padding: 8px;
                    text-align: left;
                }
                .invoice-table th {
                    background-color: #f2f2f2;
                }
            </style>
        </head>
        <body>
            <div class='invoice'>
                <div class='invoice-header'>
                    <h1>Invoice</h1>
                </div>
                <div class='invoice-details'>
                    <table class='invoice-table'>
                        <tr>
                            <th>Details</th>
                            <th>Values</th>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{$row['name']}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{$row['email']}</td>
                        </tr>
                         <tr>
                            <td>Origin</td>
                            <td>{$row['origin']}</td>
                        </tr>
                        <tr>
                            <td>Destination</td>
                            <td>{$row['destination']}</td>
                        </tr>
                        
                        <tr>
                            <td>Departure Date</td>
                            <td>{$row['booking_date']}</td>
                        </tr>
                        <tr>
                            <td>Arrival Date</td>
                            <td>{$row['arrival_date']}</td>
                        </tr>
                        <tr>
                            <td>Travelers</td>
                            <td>{$row['travellers']}</td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>{$row['booking_class']}</td>
                        </tr>
                        <tr>
                            <td>Class Price</td>
                            <td>{$row['class_price']}</td>
                        </tr>
                        <tr>
                            <td>Food Name</td>
                            <td>{$row['food_name']}</td>
                        </tr>
                        <tr>
                            <td>Food Price</td>
                            <td>{$row['food_price']}</td>
                        </tr>
                        <tr>
                            <td>Flight ID</td>
                            <td>{$row['flight_id']}</td>
                        </tr>
                        <tr>
                            <td>Flight Price</td>
                            <td>{$row['flight_price']}</td>
                        </tr>
                        
                        <tr>
                            <td>Total Amount</td>
                            <td>{$row['total']}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </body>
        </html>
        ";

        // Generate and stream PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output the generated PDF to the browser for download
        $dompdf->stream("invoice.pdf", array("Attachment" => true));
    } else {
        echo "No billing data found for the provided email.";
    }

    mysqli_stmt_close($billing_stmt);
} else {
    echo "Invalid email provided.";
}

mysqli_close($con);
?>
