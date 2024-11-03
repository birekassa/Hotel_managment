<?php
include '../assets/conn.php';

// Initialize variables
$rooms = [];
$room_type = '';

// Check if room type is set
if (isset($_POST['my_update_room_type'])) {
    $room_type = $_POST['my_update_room_type'];

    // Prepare and execute SQL statement to get available rooms
    $stmt = $conn->prepare("SELECT r_id, r_price FROM table_rooms WHERE r_type = ?");
    if ($stmt) {
        $stmt->bind_param("s", $room_type);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $rooms[] = $row;
        }
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
