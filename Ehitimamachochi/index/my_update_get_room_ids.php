<?php
//include database connection
include '../assets/conn.php';

// Get the room type from the GET request
$room_type = $_GET['my_update_room_type'] ?? '';

if ($room_type) {
    // Prepare the SQL statement to fetch room IDs
    $stmt = $conn->prepare("SELECT r_id, r_type FROM table_rooms WHERE r_type = ?");
    
    if ($stmt) {
        // Bind the room type parameter to the SQL query
        $stmt->bind_param("s", $room_type);
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();

        // Initialize an array to store room data
        $rooms = [];
        
        // Fetch all rows as associative arrays and add to rooms array
        while ($row = $result->fetch_assoc()) {
            $rooms[] = $row;
        }

        // Output the rooms array as JSON
        echo json_encode($rooms);

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
