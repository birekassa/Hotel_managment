
<?php
header('Content-Type: application/json');

//include database connection
include 'conn.php';

// Retrieve the category from the request
$category = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';

// Prepare SQL query
$sql = "SELECT item_name, category, quantity, price, created_at FROM table_foods";
if ($category) {
    $sql .= " WHERE category = '$category'";
}

$result = $conn->query($sql);

// Fetch data and encode as JSON
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

// Close connection
$conn->close();
?>
