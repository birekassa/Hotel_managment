<?php
//include database connection
include '../assets/conn.php';

// Check if form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $reportProvider = $_POST['report_provider'];
    $to_whom = $_POST['to_whom'];
    $reportType = $_POST['report_type'];
    $reportedDate = $_POST['reported_date'];
    $items = $_POST['list'];
    $measurements = $_POST['measurement'];
    $quantities = $_POST['quantity'];
    $singlePrices = $_POST['single_price'];

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Prepare SQL statement for inserting into transferred_items
        $stmt = $conn->prepare("INSERT INTO `transferred_items` (`Report Provider`, `To_Which`, `item_name`, `item_type`, `item_measurement`, `item_quantity`, `item_single_price`, `item_total_price`, `reported_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssdids", $reportProvider, $to_whom, $itemName, $reportType, $measurement, $quantity, $singlePrice, $totalPrice, $reportedDate);

        // Process each item in the form
        foreach ($items as $index => $itemName) {
            $measurement = $measurements[$index];
            $quantity = (int) $quantities[$index];
            $singlePrice = (float) $singlePrices[$index];
            $totalPrice = $singlePrice * $quantity;

            // Check the current quantity in `wechi`
            $checkQuantity = $conn->prepare("SELECT quantity FROM `wechi` WHERE item_name = ?");
            $checkQuantity->bind_param("s", $itemName);
            $checkQuantity->execute();
            $result = $checkQuantity->get_result();
            $itemData = $result->fetch_assoc();

            if ($itemData && $itemData['quantity'] >= $quantity) {
                // Calculate new quantity
                $newQuantity = $itemData['quantity'] - $quantity;

                // Update quantity in `wechi`
                $updateQuantity = $conn->prepare("UPDATE `wechi` SET quantity = ? WHERE item_name = ?");
                $updateQuantity->bind_param("ds", $newQuantity, $itemName);
                $updateQuantity->execute();
                $updateQuantity->close();

                // Insert into transferred_items
                if (!$stmt->execute()) {
                    throw new Exception("Error inserting record: " . $stmt->error);
                }
            } else {
                throw new Exception("Insufficient quantity for item: " . $itemName);
            }
        }

        // Commit transaction
        $conn->commit();

        // Success message
        header("Location: outstock_items.php?status=success");
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
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }

    // Close statement and connection
    $stmt->close();
    $checkQuantity->close();
    $conn->close();
    exit();
} else {
    echo "Invalid request method.";
}
?>
