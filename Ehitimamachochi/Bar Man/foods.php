<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "24770267";
$dbname = "ehms_db";
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch all food data from the table
$query = "SELECT `item_name`, `category`, `purchase_price`, `price` FROM `table_foods`";
$result = $mysqli->query($query);

$foods = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $foods[] = $row;
    }
}

// Close the database connection
$mysqli->close();
?>

<script>
    // Store the PHP data in a JavaScript variable
    const foodData = <?php echo json_encode($foods); ?>;
</script>

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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #343a40;
            height: 100px;
        }

        .navbar-nav {
            flex-direction: row;
        }

        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            font-size: 18px;
        }

        .nav-item {
            margin: 10px;
        }


        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        /* Section visibility styles */
        section {
            display: none;
        }

        #defaultSection {
            display: block;
        }

        .table-container {
            margin-top: 30px;
        }

        .nav-item:hover {
            font-size: 17px;
            border-bottom: 1px blue solid;
            background-color: #333;
        }
    </style>
</head>

<body class="d-flex flex-column" style="font-family: 'Times New Roman', Times, serif;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Bar-man panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" >
                            Back
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('defaultSection')">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('addFoodSection')">
                            <i class="bi bi-plus-circle"></i> Add Food
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('viewFoodSection')">
                            <i class="bi bi-eye"></i> View Food
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('updateFoodSection')">
                            <i class="bi bi-pencil-square"></i> Update Food
                        </a>
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
                            Today's Prepared Normal Food Quantity
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
                            Today's Prepared Fast Food Quantity
                        </div>
                        <div class="card-body">
                            <p>This is under construction</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="addFoodSection" class="container mt-5">
            <h1>Add Food</h1>
            <p>Here you can add new food items to the menu.</p>
            <!-- Form starts here -->
            <form action="insert_foods.php" method="POST">
                <div class="table-responsive table-container">
                    <table class="table table-bordered" id="foodTable">
                        <thead>
                            <tr>
                                <th>Food Name</th>
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
                                        <option value="food">Normal Food</option>
                                        <option value="fast_food">Fast Food</option>
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


        <!-- viewFoodSection -->
        <section id="viewFoodSection" class="container mt-5">
            <h1>View Food</h1>
            <p>Here you can view all food items currently in the menu.</p>
            <div class="d-flex justify-content-center align-items-center gap-4 my-3">
                <button style="width: 40%;" type="button" onclick="filterCategory('food')"
                    class="btn btn-success">Normal Food</button>
                <button style="width: 40%;" type="button" onclick="filterCategory('fast_food')"
                    class="btn btn-primary">Fast Food</button>
                <button style="width: 40%;" type="button" onclick="filterCategory('all')" class="btn btn-secondary">List
                    All Food</button>
            </div>

            <div id="viewFoodTableContainer" class="table-responsive">
                <!-- Table will be inserted here by JavaScript -->
            </div>

            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "24770267";
            $dbname = "ehms_db";
            $mysqli = new mysqli($servername, $username, $password, $dbname);

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            // Fetch all food data from the table
            $query = "SELECT item_name, category, purchase_price, quantity, price FROM table_foods";
            $result = $mysqli->query($query);

            $foods = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $foods[] = $row;
                }
            }
            $mysqli->close();

            // Convert PHP data to JSON format for use in JavaScript
            echo '<script>';
            echo 'const viewFoodData = ' . json_encode($foods) . ';';
            echo '</script>';
            ?>
        </section>

        <script>
            // Function to generate table HTML
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
            </tr>
        `;
                });

                tableHTML += '</tbody></table>';
                document.getElementById('viewFoodTableContainer').innerHTML = tableHTML;
            }

            // Function to filter data by category
            function filterCategory(category) {
                let filteredData = viewFoodData;
                if (category !== 'all') {
                    filteredData = viewFoodData.filter(food => food.category === category);
                }
                generateTable(filteredData);
            }

            // Initial load: show all items
            filterCategory('all');
        </script>



        <!-- updateFoodSection -->

        <section id="updateFoodSection" class="container mt-5">
            <h1>Update Food</h1>
            <p>Here you can update details of existing food items.</p>
            <form action="update_foods.php" method="POST">
                <div class="table-responsive table-container">
                    <table class="table table-bordered" id="foodTable">
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
                                        <option value="food">Normal Food</option>
                                        <option value="fast_food">Fast Food</option>
                                    </select>
                                </td>
                                <!-- Purchase Price input -->
                                <td><input type="number" name="purchase_price[]" class="form-control purchase-price"
                                        readonly required></td>
                                <!-- Quantity input -->
                                <td><input type="number" name="quantity[]" class="form-control " required></td>
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

    </main>

    <!-- Footer -->
    <footer class="mt-auto">
        <p>&copy; 2024 Ehototmamachochi Hotel. All rights reserved. Powered by MTU Department of SE Group 1 Members</p>
    </footer>

    <!-- JavaScript to handle row addition, removal, and dynamic data update -->
    <script>
        function updateItemNames(categorySelect) {
            const selectedCategory = categorySelect.value;
            const row = categorySelect.closest('tr');
            const itemNameSelect = row.querySelector('.item-name');

            // Clear the current options
            itemNameSelect.innerHTML = '<option value="">Select Item</option>';

            // Filter food data based on the selected category
            const filteredFoods = foodData.filter(food => food.category === selectedCategory);

            // Populate item names based on filtered data
            filteredFoods.forEach(food => {
                const option = document.createElement('option');
                option.value = food.item_name;
                option.textContent = food.item_name;
                itemNameSelect.appendChild(option);
            });

            // Reset price fields
            row.querySelector('.purchase-price').value = '';
            row.querySelector('.price').value = '';
        }

        function updatePrices(itemSelect) {
            const selectedItemName = itemSelect.value;
            const row = itemSelect.closest('tr');
            const purchasePriceInput = row.querySelector('.purchase-price');
            const priceInput = row.querySelector('.price');

            // Find the selected item data
            const selectedItem = foodData.find(food => food.item_name === selectedItemName);

            if (selectedItem) {
                purchasePriceInput.value = selectedItem.purchase_price;
                priceInput.value = selectedItem.price;
            } else {
                purchasePriceInput.value = '';
                priceInput.value = '';
            }
        }

        function addRow() {
            const table = document.getElementById('foodTable').getElementsByTagName('tbody')[0];
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
                            <option value="food">Normal Food</option>
                            <option value="fast_food">Fast Food</option>
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
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>