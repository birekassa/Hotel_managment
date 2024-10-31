<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '24770267', 'ehms_db');

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Fetch room types and their counts where rooms are available (r_status = 'free')
$sql = "SELECT *, COUNT(*) AS count FROM table_rooms WHERE r_status = 'free' GROUP BY r_type";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(['error' => 'Query failed']);
    exit;
}

$roomTypes = [];
while ($row = $result->fetch_assoc()) {
    $roomTypes[] = $row;
}

echo json_encode($roomTypes);
$conn->close();
?>
