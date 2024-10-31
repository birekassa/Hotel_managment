
<?php
// Database connection
include 'Ehitimamachochi\assets\conn.php';

// Start a transaction
$mysqli->begin_transaction();

try {
    // Prepare statements for fetching and updating
    $stmtFetchInsertedQuantity = $mysqli->prepare("SELECT quantity FROM inserted_foods WHERE item_name = ?");
    $stmtUpdateInsertedQuantity = $mysqli->prepare("UPDATE inserted_foods SET quantity = ? WHERE item_name = ?");
    
    $stmtFetchTableQuantity = $mysqli->prepare("SELECT quantity FROM table_foods WHERE item_name = ?");
    $stmtUpdateTableQuantity = $mysqli->prepare("UPDATE table_foods SET quantity = ? WHERE item_name = ?");
    
    if ($stmtFetchInsertedQuantity === false || $stmtUpdateInsertedQuantity === false || $stmtFetchTableQuantity === false || $stmtUpdateTableQuantity === false) {
        throw new Exception("Prepare failed: " . $mysqli->error);
    }

    // Get form data
    $item_names = $_POST['item_name'];
    $categories = $_POST['category'];
    $purchase_prices = $_POST['purchase_price'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];

    // Update food items in the database
    for ($i = 0; $i < count($item_names); $i++) {
        $item_name = $item_names[$i];
        $category = $categories[$i];
        $purchase_price = $purchase_prices[$i];
        $quantity = $quantities[$i];
        $price = $prices[$i];

        // Fetch previously inserted quantity
        $stmtFetchInsertedQuantity->bind_param("s", $item_name);
        if (!$stmtFetchInsertedQuantity->execute()) {
            throw new Exception("Error fetching inserted quantity: " . $stmtFetchInsertedQuantity->error);
        }
        $resultInserted = $stmtFetchInsertedQuantity->get_result();
        $rowInserted = $resultInserted->fetch_assoc();
        $inserted_quantity = $rowInserted ? $rowInserted['quantity'] : 0;

        // Fetch previously in table_foods
        $stmtFetchTableQuantity->bind_param("s", $item_name);
        if (!$stmtFetchTableQuantity->execute()) {
            throw new Exception("Error fetching table quantity: " . $stmtFetchTableQuantity->error);
        }
        $resultTable = $stmtFetchTableQuantity->get_result();
        $rowTable = $resultTable->fetch_assoc();
        $previously_table_quantity = $rowTable ? $rowTable['quantity'] : 0;

        // Calculate new quantity
        $newquantity = $previously_table_quantity - $inserted_quantity + $quantity;

        // Update quantities in both tables
        $stmtUpdateInsertedQuantity->bind_param("is", $quantity, $item_name);
        if (!$stmtUpdateInsertedQuantity->execute()) {
            throw new Exception("Error updating inserted_foods: " . $stmtUpdateInsertedQuantity->error);
        }

        $stmtUpdateTableQuantity->bind_param("is", $newquantity, $item_name);
        if (!$stmtUpdateTableQuantity->execute()) {
            throw new Exception("Error updating table_foods: " . $stmtUpdateTableQuantity->error);
        }
    }

    // Commit the transaction
    $mysqli->commit();

    // Provide feedback
    echo "Food items updated successfully!";
} catch (Exception $e) {
    // Rollback the transaction on error
    $mysqli->rollback();
    echo "Error: " . $e->getMessage();
} finally {
    // Close the prepared statements and the connection
    if ($stmtFetchInsertedQuantity) $stmtFetchInsertedQuantity->close();
    if ($stmtUpdateInsertedQuantity) $stmtUpdateInsertedQuantity->close();
    if ($stmtFetchTableQuantity) $stmtFetchTableQuantity->close();
    if ($stmtUpdateTableQuantity) $stmtUpdateTableQuantity->close();
    $mysqli->close();
}
?>
