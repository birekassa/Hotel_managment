<?php
//include database connection
include '../assets/conn.php';

$room_id = $_GET['room_id'] ?? '';

if ($room_id) {
    // Prepare the SQL statement to fetch the room price
    $stmt = $conn->prepare("SELECT r_price FROM table_rooms WHERE r_id = ?");
    if ($stmt) {
        // Bind the room ID parameter to the SQL query
        $stmt->bind_param("s", $room_id);
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();

        // Initialize an array to store room data
        $room = [];
        
        // Fetch the row as an associative array and add to room array
        if ($row = $result->fetch_assoc()) {
            $room[] = $row;
        }

        // Output the room array as JSON
        echo json_encode($room);

        // Close the statement
        $stmt->close();
    } else {
        // Handle error in preparing the statement
        echo json_encode(["error" => "Failed to prepare statement"]);
    }
}

// Close the connection
$conn->close();
?>
