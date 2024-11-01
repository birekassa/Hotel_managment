
<?php
//include database connection
include '../assets/conn.php';

// Get the search date from the request
$searchDate = isset($_GET['searchDate']) ? $_GET['searchDate'] : '';

// Initialize the query
$query = "SELECT room_type, room_id, room_price, checkin_date, checkout_date, assigned_by FROM reserved_rooms WHERE 1";

// If a date is provided, add it to the query
if ($searchDate) {
    $query .= " AND (checkin_date = '$searchDate')";
}

// Execute the query
$result = $conn->query($query);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['room_type']}</td>
            <td>{$row['room_id']}</td>
            <td>{$row['room_price']}</td>
            <td>{$row['checkin_date']}</td>
            <td>{$row['checkout_date']}</td>
            <td>{$row['assigned_by']}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No reserved rooms on this day</td></tr>";
}

// Close connection
$conn->close();
?>
