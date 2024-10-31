
<?php
// Database connection
include 'Ehitimamachochi\assets\conn.php';

function showAlert($icon, $title, $text) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                text: '$text',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
        });
    </script>";
}

// Start a transaction
$mysqli->begin_transaction();

try {
    // Prepare the SQL statements
    $stmt1 = $mysqli->prepare("INSERT INTO inserted_foods (item_name, category,quantity, purchase_price, price) VALUES (?, ?, ?, ?, ?)");
    $stmt2 = $mysqli->prepare("UPDATE table_foods SET quantity = quantity + ? WHERE item_name = ?");

    // Check if statements preparation was successful
    if ($stmt1 === false || $stmt2 === false) {
        throw new Exception("Prepare failed: " . $mysqli->error);
    }

    // Get form data
    $item_names = $_POST['item_name'];
    $categories = $_POST['category'];
    $purchase_prices = $_POST['purchase_price'];
    $prices = $_POST['price'];
    $quantities = $_POST['quantity'];

    for ($i = 0; $i < count($item_names); $i++) {
        $item_name = $item_names[$i];
        $category = $categories[$i];
        $purchase_price = $purchase_prices[$i];
        $price = $prices[$i];
        $quantity = $quantities[$i];

        // Insert new food item into inserted_foods table
        $stmt1->bind_param("ssddd", $item_name, $category,$quantity, $purchase_price, $price);
        if (!$stmt1->execute()) {
            throw new Exception("Error inserting into inserted_foods: " . $stmt1->error);
        }

        // Update quantity in table_foods table
        $stmt2->bind_param("is", $quantity, $item_name);
        if (!$stmt2->execute()) {
            throw new Exception("Error updating table_foods: " . $stmt2->error);
        }
    }

    // Commit the transaction
    $mysqli->commit();

    // Provide success feedback
    showAlert('success', 'Success', 'Food inserted successfully!');
} catch (Exception $e) {
    // Rollback the transaction on error
    $mysqli->rollback();
    // Provide error feedback
    showAlert('error', 'Error', $e->getMessage());
} finally {
    // Close the prepared statements and the connection
    if ($stmt1) $stmt1->close();
    if ($stmt2) $stmt2->close();
    $mysqli->close();
}

exit();
?>
