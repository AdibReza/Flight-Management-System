<?php
// Mock seat map data
$seatMap = [
    ["A1", "A2", "0", "A3"],
    ["B1", "0", "B2", "B3"],
    ["0", "C1", "C2", "0"],
    ["D1", "D2", "D3", "D4"],
    ["0", "0", "E1", "E2"],
];

// Display seat map
echo '<table>';
for ($row = 0; $row < count($seatMap); $row++) {
    echo '<tr>';
    for ($seat = 0; $seat < count($seatMap[$row]); $seat++) {
        $seatNumber = $seatMap[$row][$seat];
        if ($seatNumber !== "0") {
            // Display the seat number as a link to book the seat
            echo '<td><a href="book_seat.php?row=' . $row . '&seat=' . $seat . '">' . $seatNumber . '</a></td>';
        } else {
            // Display an empty cell for seats marked as 0
            echo '<td></td>';
        }
    }
    echo '</tr>';
}
echo '</table>';
?>
