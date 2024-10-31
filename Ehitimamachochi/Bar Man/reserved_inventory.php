<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserved Inventory</title>
    <!-- Latest Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
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
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'foods.php' ? 'active' : ''; ?>" href="foods.php">Manage Food List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'beverages.php' ? 'active' : ''; ?>" href="beverages.php">Manage Beverage List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : ''; ?>" href="reports.php">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>" href="settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-4">
        <div id="searchByDate" class="mb-4">
            <!-- Date input and search button -->
            <input type="date" class="form-control d-inline w-auto me-2" id="searchDate">
            <button class="btn btn-primary" onclick="searchByDate()"><i class="bi bi-search"></i> Search</button>
            <button class="btn btn-secondary" onclick="listAll()"><i class="bi bi-list"></i> List All</button>
        </div>

        <h2 class="text-center">Sold Inventory</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Reserved At</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Table data will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript for AJAX request -->
    <script>
        // Function to fetch and display all records by default
        window.onload = function() {
            listAll(); // Automatically fetch all records on page load
        };

        // Function to handle search by date (manual or default)
        function searchByDate(searchDate = null) {
            // If no searchDate is provided, get the date from the input field
            if (!searchDate) {
                searchDate = document.getElementById('searchDate').value;
            }

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'searchReservedInventory.php?searchDate=' + searchDate, true);

            // When the request is complete, update the table body with the response
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('tableBody').innerHTML = this.responseText;
                }
            };

            // Send the request
            xhr.send();
        }

        // Function to list all records
        function listAll() {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'searchReservedInventory.php', true);

            // When the request is complete, update the table body with the response
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('tableBody').innerHTML = this.responseText;
                }
            };

            // Send the request
            xhr.send();
        }
    </script>
</body>
</html>
