<?php
// Include database connection
include '../assets/conn.php';
session_start(); // Start the session

// // Check if the user's position is 'casher'
// if ($_SESSION['position'] !== 'store' && $_SESSION['position'] !== 'Store') {
//     // Redirect to login page if the user is not a 'casher'
//     header("Location: ../index/index.php");
//     exit();
// }

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../index/index.php");
    exit();
}

$position = $_SESSION['position'];
$report_provider_name = ''; // Initialize variable

// Prepare and execute statement to fetch first name, last name, and ID number based on the username
$stmt = $conn->prepare("SELECT f_name, l_name, id FROM employees WHERE username = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($f_name, $l_name, $id);
$stmt->fetch();

// Check if names and ID were retrieved successfully
if ($f_name && $l_name && $id) {
    $report_provider_name = 'ID: ' . $id . ',   Name : ' . $f_name . ' ' . $l_name; // Combine first name, last name, and ID
} else {
    $report_provider_name = 'Unknown Provider'; // Fallback if no name or ID is found
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store_man/outstock_items Page / Out-Stock Items - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .nav-item {
            font-size: 16px;
        }

        .nav-item:hover {
            border-bottom: 1px solid blue;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        #defaultSection {
            display: block;
        }

        /* Additional styling for the report section */
        .report-section {
            margin-top: 20px;
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">

    <div class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem; height: 100px;">
            <div class="container-xl h-100">
                <!-- Toggle button for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar content -->
                <a class="navbar-brand" href="index.php">Store Man Panel</a>
                <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php" style="margin: 0 1rem;"
                                onclick="showSection('defaultSection')">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="instock_items.php" style="margin: 0 1rem;">In-Stock
                                Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="outstock_items.php" style="margin: 0 1rem;">Out-Stock
                                Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="reports.php" style="margin: 0 1rem;">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="settings.php" style="margin: 0 1rem;">Account
                                Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Write Reports Section -->
        <section id="WriteReports" class="container-fluid report-section">
            <h2 style="text-align:center; margin-bottom:20px;">የ እቃ ማውጫ ቅጽ</h2>
            <form action="outstock_items_process.php" method="post" onsubmit="return validateForm();">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <label for="report_provider" class="me-2">Your Name:</label>
                        <input type="text" class="form-control" name="report_provider" id="report_provider"value="<?php echo htmlspecialchars($report_provider_name); ?>" readonly required>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="to_whom" class="me-2">To Which Staff:</label>
                        <select name="to_whom" id="to_whom" style="padding: 5px;" required aria-label="To Which Staff">
                            <option value="" selected>Select Staff</option>
                            <option value="Manager">Manager</option>
                            <option value="Casher">Casher</option>
                            <option value="Bar_man">Bar man</option>
                            <option value="host">Host</option>
                            <option value="Perchaser">Perchaser</option>
                            <option value="Reception">Reception</option>
                            <option value="shaff">Shaff</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="report_type" class="me-2">Item Type:</label>
                        <select name="report_type" id="report_type" style="padding: 5px;" required
                            aria-label="Report Type">
                            <option value="" selected>Select report type</option>
                            <option value="beverages">Beverages</option>
                            <option value="other_expenditure">Other Expenditure</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="reported_date" class="me-2">Reported Date:</label>
                        <input type="date" class="form-control" name="reported_date" id="reported_date" required
                            readonly>
                    </div>
                    <script>
                        // Set the reported date to today's date
                        document.getElementById('reported_date').value = new Date().toISOString().split('T')[0];
                    </script>
                </div>
                <table id="reportTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item Name</th>
                            <th>Measurement</th>
                            <th>Quantity</th>
                            <th>Single Price</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic rows will be added here -->
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" onclick="addRow()">Add Row</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </section>

        <footer class="footer bg-dark text-white text-center py-4 mt-auto">
            <div class="container">
                <p style="margin: 0;">&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            let rowCount = 0;

            function addRow() {
                rowCount++;
                const tableBody = document.querySelector('#reportTable tbody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
            <td>${rowCount}</td>
            <td><input type="text" name="list[]" class="form-control" onchange="checkItemExists(this);" required></td>
            <td><input type="text"  name="measurement[]" class="form-control" readonly required></td>
            <td><input type="number" name="quantity[]" class="form-control" step="any" required></td>
            <td><input type="number" name="single_price[]" class="form-control" step="any"readonly required></td>
            <td><input type="number" name="total_price[]" class="form-control" step="any" readonly></td>
            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
        `;
                tableBody.appendChild(newRow);

                // Attach event listeners
                newRow.querySelector('input[name="quantity[]"]').addEventListener('input', updateTotalPrice);
                newRow.querySelector('input[name="single_price[]"]').addEventListener('input', updateTotalPrice);
            }

            function removeRow(button) {
                const row = button.closest('tr');
                row.remove();
                updateRowNumbers();
            }

            function updateRowNumbers() {
                const rows = document.querySelectorAll('#reportTable tbody tr');
                rows.forEach((row, index) => {
                    row.querySelector('td:first-child').textContent = index + 1;
                });
                rowCount = rows.length;
            }

            function updateTotalPrice(event) {
                const row = event.target.closest('tr');
                const quantity = parseFloat(row.querySelector('input[name="quantity[]"]').value) || 0;
                const singlePrice = parseFloat(row.querySelector('input[name="single_price[]"]').value) || 0;
                const totalPrice = quantity * singlePrice;
                row.querySelector('input[name="total_price[]"]').value = totalPrice.toFixed(2);
            }

            function validateForm() {
                // Ensure each row has data
                const rows = document.querySelectorAll('#reportTable tbody tr');
                let isValid = true;
                let errorMessages = [];

                rows.forEach((row, index) => {
                    const list = row.querySelector('input[name="list[]"]').value.trim();
                    const measurement = row.querySelector('input[name="measurement[]"]').value.trim();
                    const quantity = row.querySelector('input[name="quantity[]"]').value.trim();
                    const singlePrice = row.querySelector('input[name="single_price[]"]').value.trim();

                    if (!list || !measurement || !quantity || !singlePrice) {
                        isValid = false;
                        errorMessages.push(`Row ${index + 1} is incomplete.`);
                    }
                });

                if (!isValid) {
                    alert('Please fill out all required fields:\n' + errorMessages.join('\n'));
                    return false;
                }

                return true;
            }
            // i went to check not item name only i went to check that its thre request Quantity is avaliable for now or not with iths currnnt measurment  and single price mustbe the same or the tabe sould filled daynamically when the name of item is inserted
            function checkItemExists(input) {
                const itemName = input.value;
                const row = input.closest('tr');

                // AJAX request to check item details in the database
                fetch('check_item_exists.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ item_name: itemName })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            // If item exists, fill in measurement, single price, and check quantity
                            row.querySelector('input[name="measurement[]"]').value = data.measurement;
                            row.querySelector('input[name="single_price[]"]').value = data.single_price;

                            // Check if requested quantity exceeds available quantity
                            const quantityField = row.querySelector('input[name="quantity[]"]');
                            quantityField.addEventListener('input', () => {
                                const requestedQuantity = parseFloat(quantityField.value) || 0;
                                if (requestedQuantity > data.available_quantity) {
                                    alert('Requested quantity exceeds available stock.');
                                    quantityField.value = ''; // Clear the invalid quantity
                                }
                            });
                        } else {
                            alert('Item does not exist in stock.');
                            input.value = ''; // Clear the invalid item name
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            window.onload = function () {
                for (let i = 0; i < 4; i++) {
                    addRow();
                }
            };
        </script>
</body>

</html>