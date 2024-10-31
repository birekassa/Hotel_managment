<?php
include '../assets/conn.php';

// Fetch all beverage data from the table
$query = "SELECT `item_name`, `category`, `quantity`, `purchase_price`, `price`, `created_at` FROM `table_beverages`";
$result = $conn->query($query);

$beverages = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $beverages[] = $row;
    }
} else {
    // Handle query error
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

<script>
    // Store the PHP data in a JavaScript variable
    const beverageData = <?php echo json_encode($beverages); ?>;
</script>