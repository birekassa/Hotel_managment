
<?php
// Include the database connection file
include 'conn.php';

// Check if searchDate is provided, otherwise list all
$searchDate = isset($_GET['searchDate']) ? $_GET['searchDate'] : null;

// Prepare the SQL statement
$sql = "SELECT `item_name`, `item_category`, `item_quantity`, `item_price`, `created_at` FROM `reserved_inventory`";
if ($searchDate) {
    $sql .= " WHERE DATE(`created_at`) = ?";
}

// Prepare the statement
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind the date parameter if provided
if ($searchDate) {
    $stmt->bind_param('s', $searchDate);
}

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch data and output as table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['item_category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['item_quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['item_price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
