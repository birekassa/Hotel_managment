<?php
//include database connection
include '../assets/conn.php';

// Get the JSON input from the fetch request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['item_name'])) {
    $itemName = $conn->real_escape_string($data['item_name']);

    // Query to get item details if the item exists in the specified format
    $sql = "SELECT item_name, measurement, quantity AS available_quantity, single_price 
            FROM wechi 
            WHERE item_name = '$itemName' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch item details
        $itemData = $result->fetch_assoc();
        $itemData['exists'] = true; // Include exists flag
        echo json_encode($itemData);
    } else {
        echo json_encode(['exists' => false]);
    }
} else {
    // If item_name is not provided in the JSON input
    echo json_encode(['error' => 'No item name provided.']);
}

// Close the database connection
$conn->close();
?>
