<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "24770267";
$dbname = "ehms_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $reportProvider = $_POST['report_provider'];
    $reportType = $_POST['report_type'];
    $reportedDate = $_POST['reported_date'];
    $items = $_POST['list'];
    $measurements = $_POST['measurement'];
    $quantities = $_POST['quantity'];
    $singlePrices = $_POST['single_price'];
    
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO wechi (report_provider, report_type, reported_date, item_name, measurement, quantity, single_price, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssdid", $reportProvider, $reportType, $reportedDate, $itemName, $measurement, $quantity, $singlePrice, $totalPrice);

    // Insert each row of data
    foreach ($items as $index => $itemName) {
        $measurement = $measurements[$index];
        $quantity = (int) $quantities[$index];  // Change to int if quantity is an integer
        $singlePrice = (float) $singlePrices[$index];
        $totalPrice = $singlePrice * $quantity;  // Calculate total price

        // Execute prepared statement for each row
        if (!$stmt->execute()) {
            // Handle execution error
            echo "Error inserting record: " . $stmt->error;
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect with success message
    header("Location: instock_items.php?status=success");
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Items inserted successfully'
        }).then(() => {
            window.history.back();
        });
    </script>";
    exit();
} else {
    echo "Invalid request method.";
}
?>
