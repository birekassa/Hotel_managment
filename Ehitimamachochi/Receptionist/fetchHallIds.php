<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '24770267', 'ehms_db');

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

if (!isset($_GET['hallType'])) {
    echo json_encode(['error' => 'No hall type provided']);
    exit();
}

$hallType = $conn->real_escape_string($_GET['hallType']);

$query = "SELECT id, type FROM table_meeting_halls WHERE type = '$hallType' AND status = 'free'";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(['error' => 'Query failed']);
    exit;
}

$hallIds = [];
while ($row = $result->fetch_assoc()) {
    $hallIds[] = $row;
}

echo json_encode($hallIds);

$conn->close();
?>
