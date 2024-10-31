
<?php
//include database connection
include 'conn.php';

// Get the search date if provided
$searchDate = isset($_GET['searchDate']) ? $_GET['searchDate'] : '';

// SQL query based on the presence of search date
$sql = "SELECT `hall_type`, `hall_id`, `checkin_date`, `checkout_date`, `hall_price`, `assigned_by` FROM `reserved_meeting_halls` WHERE 1";
if ($searchDate) {
    $sql .= " AND DATE(`checkin_date`) = '" . $conn->real_escape_string($searchDate) . "'";
}

$result = $conn->query($sql);

// Generate HTML table rows
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['hall_type']}</td>
                <td>{$row['hall_id']}</td>
                <td>{$row['checkin_date']}</td>
                <td>{$row['checkout_date']}</td>
                <td>\${$row['hall_price']}</td>
                <td>{$row['assigned_by']}</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No reserved halls at this date</td></tr>";
}

$conn->close();
?>
