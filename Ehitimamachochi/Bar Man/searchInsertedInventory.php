
<?php
// Include the database connection file
include 'Ehitimamachochi\assets\conn.php';

// Check if "listAll" parameter is passed, indicating the user clicked "List all"
if (isset($_GET['listAll']) && $_GET['listAll'] == 'true') {
    // Query to get all records without filtering by date
    $sql = "SELECT `item_name`, `category`, `quantity`, `purchase_price`, `price`, `created at` FROM `inserted_foods`";
} else {
    // Otherwise, filter by the provided date (or today's date if no date is provided)
    $searchDate = isset($_GET['searchDate']) ? $_GET['searchDate'] : date('Y-m-d');
    $sql = "SELECT `item_name`, `category`, `quantity`, `purchase_price`, `price`, `created at` FROM `inserted_foods` WHERE DATE(`created at`) = '$searchDate'";
}

// Execute the query
$result = $conn->query($sql);

// Generate the table rows dynamically based on the query results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['purchase_price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['created at']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
}

// Close the database connection
$conn->close();
?>
