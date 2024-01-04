<!DOCTYPE html>
<html>
<head>
    <title>Destination Page</title>
</head>
<body>
    <h1>Flight Details</h1>
    <?php
        if(isset($_GET['from']) && isset($_GET['to']) && isset($_GET['departure'])) {
            $from = $_GET['from'];
            $to = $_GET['to'];
            $departure = $_GET['departure'];
            
            echo "From: $from<br>";
            echo "To: $to<br>";
            echo "Departure: $departure<br>";
            
        } else {
            echo "<p>No data provided.</p>";
        }
    ?>
</body>
</html>
