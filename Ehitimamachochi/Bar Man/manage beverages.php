<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Management - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .navbar-nav {
            justify-content: center;
            /* Center-align the nav items */
            width: 100%;
            /* Ensure the ul takes full width to center items properly */
            gap: 10px;
        }

        .navbar {
            margin-bottom: 0;
            background-color: #343a40;
            height: 100px;
            align-items: center;
            gap: 10px;
        }

        .nav-item {
            margin: 10px;
        }

        .nav-item:hover {
            font-size: 17px;
            border-bottom: 1px blue solid;
            background-color: #333;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Bar-man Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Back</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('defaultSection')"> <i class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('addBeverageSection')">
                            <i class="bi bi-plus-circle"></i> Add Beverage
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('viewBeverageSection')"><i class="bi bi-eye"></i> View Beverage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('updateBeverageSection')"><i class="bi bi-pencil-square"></i> Update Beverage</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main content -->
    <main class="flex-fill">
        <!-- Sections -->
        <section id="defaultSection" class="container mt-5">
            <h1>Welcome to Food Management System</h1>
            <div class="row">
                <!-- Card 1 -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header" style="background-color:#333;color:white;">
                            Today's Prepared Soft-Beverages Quantity
                        </div>
                        <div class="card-body">
                            <p>This is under construction</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header" style="background-color:green;color:white;">
                            Today's Prepared Alcohol-Beverages Quantity
                        </div>
                        <div class="card-body">
                            <p>This is under construction</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="addBeverageSection" class="container mt-5" style="display: none;">
            <h1>Add Beverage</h1>
            <p>Here you can add new beverage items to the menu.</p>
            <!-- Form starts here -->
            <form action="insert_beverages.php" method="POST">
                <div class="table-responsive table-container">
                    <table class="table table-bordered" id="beverageTable">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Purchase Price</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Item Name input -->
                                <td>
                                    <select name="item_name[]" class="form-control item-name" required
                                        onchange="updatePrices(this)">
                                        <!-- JavaScript will populate options based on selected category -->
                                    </select>
                                </td>
                                <!-- Category input -->
                                <td>
                                    <select name="category[]" class="form-control category-select" required
                                        onchange="updateItemNames(this)">
                                        <option value="">Select Category</option>
                                        <option value="soft-drink">Soft-Drink</option>
                                        <option value="alcohol-drink">Alcohol-Drink</option>
                                    </select>
                                </td>
                                <!-- Purchase Price input -->
                                <td><input type="number" name="purchase_price[]" class="form-control purchase-price"
                                        readonly required></td>
                                <!-- Quantity input -->
                                <td><input type="number" name="quantity[]" class="form-control" required></td>
                                <!-- Price input -->
                                <td><input type="number" name="price[]" class="form-control price" readonly required>
                                </td>
                                <!-- Remove button -->
                                <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-4 my-3">
                    <button style="width: 40%;" type="button" class="btn btn-success" onclick="addRow()">Add
                        Row</button>
                    <button style="width: 40%;" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </section>
<!-- viewBeverageSection -->

        <section id="viewBeverageSection" class="container mt-5" style="display: none;">
            <h1>View Beverage</h1>
            <p>Here you can view all beverage items currently in the menu.</p>
            <div class="d-flex justify-content-center align-items-center gap-4 my-3">
                <button style="width: 40%;" type="button" onclick="filterCategory('soft-drink')" class="btn btn-success">Soft-Drink</button>
                <button style="width: 40%;" type="button" onclick="filterCategory('alcohol-drink')" class="btn btn-success">Alcohol-Drink</button>
                <button style="width: 40%;" type="button" onclick="filterCategory('all')" class="btn btn-secondary">List All Beverages</button>
            </div>

            <div id="viewBeverageTableContainer" class="table-responsive">
                <!-- Table will be inserted here by JavaScript -->
            </div>

            <?php
            // connection
            include '../assets/conn.php';
            $mysqli = $conn ;

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            // Fetch all beverage data from the table
            $query = "SELECT * FROM table_beverages";
            $result = $mysqli->query($query);

            $beverages = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $beverages[] = $row;
                }
            }
            $mysqli->close();

            // Convert PHP data to JSON format for use in JavaScript
            echo '<script>';
            echo 'const viewBeverageData = ' . json_encode($beverages) . ';';
            echo '</script>';
            ?>
        </section>

        <section id="updateBeverageSection" class="container mt-5" style="display: none;">
            <h1>Update Beverage</h1>
            <form action="update_beverages.php" method="POST">
                <div class="table-responsive table-container">
                    <table class="table table-bordered" id="beverageTableUpdate">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Purchase Price</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Item Name input -->
                                <td>
                                    <select name="item_name[]" class="form-control item-name-update" required
                                        onchange="updatePrices(this)">
                                        <!-- JavaScript will populate options based on selected category -->
                                    </select>
                                </td>
                                <!-- Category input -->
                                <td>
                                    <select name="category[]" class="form-control category-select-update" required
                                        onchange="updateItemNames(this)">
                                        <option value="">Select Category</option>
                                        <option value="soft-drink">Soft-Drink</option>
                                        <option value="alcohol-drink">Alcohol-Drink</option>
                                    </select>
                                </td>
                                <!-- Purchase Price input -->
                                <td><input type="number" name="purchase_price[]" class="form-control purchase-price-update" readonly required></td>
                                <!-- Quantity input -->
                                <td><input type="number" name="quantity[]" class="form-control" required></td>
                                <!-- Price input -->
                                <td><input type="number" name="price[]" class="form-control price-update" readonly required></td>
                                <!-- Remove button -->
                                <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-4 my-3">
                    <button style="width: 40%;" type="button" class="btn btn-success" onclick="addRow()">Add Row</button>
                    <button style="width: 40%;" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </section>
    </main>


    <!-- JavaScript to handle row addition, removal, and dynamic data update -->
    <script>
     // Example of initializing beverageData
    const beverageData = []; // Fetch and initialize this array with PHP data if not already done

    // Function to initialize beverage data
    function initializeBeverageData(data) {
        beverageData.length = 0; // Clear existing data
        beverageData.push(...data);
    }

    // Set the data after PHP outputs it
    initializeBeverageData(viewBeverageData);
    
        function updateItemNames(categorySelect) {
            const selectedCategory = categorySelect.value;
            const row = categorySelect.closest('tr');
            const itemNameSelect = row.querySelector('.item-name, .item-name-update');

            // Clear the current options
            itemNameSelect.innerHTML = '<option value="">Select Item</option>';

            // Filter beverage data based on the selected category
            const filteredBeverages = beverageData.filter(beverage => beverage.category === selectedCategory);

            // Populate item names based on filtered data
            filteredBeverages.forEach(beverage => {
                const option = document.createElement('option');
                option.value = beverage.item_name;
                option.textContent = beverage.item_name;
                itemNameSelect.appendChild(option);
            });

            // Reset price fields
            row.querySelector('.purchase-price, .purchase-price-update').value = '';
            row.querySelector('.price, .price-update').value = '';
        }

        function updatePrices(itemSelect) {
            const selectedItemName = itemSelect.value;
            const row = itemSelect.closest('tr');
            const purchasePriceInput = row.querySelector('.purchase-price, .purchase-price-update');
            const priceInput = row.querySelector('.price, .price-update');

            // Find the selected item data
            const selectedItem = beverageData.find(beverage => beverage.item_name === selectedItemName);

            if (selectedItem) {
                purchasePriceInput.value = selectedItem.purchase_price;
                priceInput.value = selectedItem.price;
            } else {
                purchasePriceInput.value = '';
                priceInput.value = '';
            }
        }

        function addRow() {
            const tableId = document.querySelector('.table-responsive form').id === 'beverageTable' ? 'beverageTable' : 'beverageTableUpdate';
            const table = document.getElementById(tableId).getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <tr>
                    <td>
                        <select name="item_name[]" class="form-control item-name" required onchange="updatePrices(this)">
                            <option value="">Select Item</option>
                        </select>
                    </td>
                    <td>
                        <select name="category[]" class="form-control category-select" required onchange="updateItemNames(this)">
                            <option value="">Select Category</option>
                            <option value="beverage">Beverage</option>
                        </select>
                    </td>
                    <td><input type="number" name="purchase_price[]" class="form-control purchase-price" readonly required></td>
                    <td><input type="number" name="quantity[]" class="form-control" required></td>
                    <td><input type="number" name="price[]" class="form-control price" readonly required></td>
                    <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                </tr>
            `;
            attachRemoveRowHandler();
        }

        function attachRemoveRowHandler() {
            const removeButtons = document.querySelectorAll('.remove-row');
            removeButtons.forEach(button => {
                button.onclick = function () {
                    this.closest('tr').remove();
                };
            });
        }
        // Attach handler to existing row's remove button on page load
        attachRemoveRowHandler();

        // JavaScript for dynamic section display
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('section');
            sections.forEach(section => section.style.display = 'none');

            // Show the selected section
            document.getElementById(sectionId).style.display = 'block';
        }

        // Function to generate table HTML for viewing beverages
        function generateTable(data) {
            let tableHTML = `
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Purchase Price</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
        `;

            data.forEach(row => {
                tableHTML += `
            <tr>
                <td>${row.item_name}</td>
                <td>${row.category}</td>
                <td>${row.purchase_price}</td>
                <td>${row.quantity}</td>
                <td>${row.price}</td>
                <td>${row.created_at}</td>
            </tr>
        `;
            });

            tableHTML += '</tbody></table>';
            document.getElementById('viewBeverageTableContainer').innerHTML = tableHTML;
        }

        // Function to filter data by category
        function filterCategory(category) {
            let filteredData = viewBeverageData;
            if (category !== 'all') {
                filteredData = viewBeverageData.filter(beverage => beverage.category === category);
            }
            generateTable(filteredData);
        }

        // Initial load: show all items
        filterCategory('all');
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
