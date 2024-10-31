<?php
include 'conn.php';
$room_types = ['standard', 'deluxe', 'suite', 'luxury'];
$counts = [];
foreach ($room_types as $type) {
    $sql = $conn->prepare("SELECT COUNT(*) AS count FROM table_rooms WHERE r_status='free' AND r_type=?");
    $sql->bind_param("s", $type);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    $counts[$type] = $row['count'];
}

$conn->close();

// Return the counts as a JSON object
echo json_encode($counts);
?>
