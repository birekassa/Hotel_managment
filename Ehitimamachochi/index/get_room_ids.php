<?php
include '../assets/conn.php';//include database connection
$room_type = $_GET['room_type'] ?? '';// Get the room type from the GET request
if ($room_type) {

    // Prepare the SQL statement to fetch room IDs
    $stmt = $conn->prepare("SELECT r_id, r_type FROM table_rooms WHERE r_type = ?");
    
    if ($stmt) {
        $stmt->bind_param("s", $room_type);  // Bind the room type parameter to the SQL query
        $stmt->execute(); // Execute the query
        $result = $stmt->get_result();// Get the result
        $rooms = [];// Initialize an array to store room data

        // Fetch all rows as associative arrays and add to rooms array
        while ($row = $result->fetch_assoc()) {
            $rooms[] = $row;
        }
        echo json_encode($rooms); // Output the rooms array as JSON
        $stmt->close(); // Close the statement
    } else {
        echo json_encode(["error" => "Failed to prepare statement"]); // Handle error in preparing the statement
    }
}
$conn->close(); // Close the connection
?>
