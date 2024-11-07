<?php
// Include database connection
include '../assets/conn.php';
session_start(); // Start the session

// // Check if the user's position is 'casher'
// if ($_SESSION['position'] !== 'casher' && $_SESSION['position'] !== 'Casher') {
//     // Redirect to login page if the user is not a 'casher'
//     header("Location: ../index/index.php");
//     exit();
// }

// Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//     // Redirect to login page if not logged in
//     header("Location: ../index/index.php");
//     exit();
// }

?>
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
                        <a class="nav-link" href="index.php"> <i class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="view_beverages.php">View Beverage</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="reports.php">Reports</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="Settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main content -->
    <main class="flex-fill">
        <!-- Sections -->
        <section id="defaultSection" class="container mt-5">
            <h1>View Beverage</h1>
            <p>Here you can view all beverage items currently in the menu.</p>
            <div class="d-flex justify-content-center align-items-center gap-4 my-3">
                <button style="width: 40%;" type="button" onclick="filterCategory('soft-drink')"
                    class="btn btn-success">Soft-Drink</button>
                <button style="width: 40%;" type="button" onclick="filterCategory('alcohol-drink')"
                    class="btn btn-success">Alcohol-Drink</button>
                <button style="width: 40%;" type="button" onclick="filterCategory('all')" class="btn btn-secondary">List
                    All Beverages</button>
            </div>

            <div id="viewBeverageTableContainer" class="table-responsive">
                <!-- Table will be inserted here by JavaScript -->
            </div>

            <?php
            // connection
            include '../assets/conn.php';
            $mysqli = $conn;

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            // Fetch all beverage data from the table
            $query = "SELECT `beverage_name`, `beverage_type`, `measurement`, `beverage_quantity` FROM `beverage_in_bar_man`";

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
    </main>

    <footer class="footer bg-dark text-white text-center py-4" style="margin-top: auto;">
        <div class="container">
            <p style="margin: 0;">&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
        </div>
    </footer>

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

        // Function to generate table HTML for viewing beverages
        function generateTable(data) {
            let tableHTML = `
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Measurment</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
        `;

            data.forEach(row => {
                tableHTML += `
            <tr>
                <td>${row.beverage_name}</td>
                <td>${row.beverage_type}</td>
                <td>${row.measurement}</td>
                <td>${row.beverage_quantity}</td>
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