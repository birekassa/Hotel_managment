<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserved Meeting Halls</title>
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
            width: 100%;
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
                <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php" style="margin: 0 1rem;" onclick="showSection('defaultSection')">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Reports.php" style="margin: 0 1rem;">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="payment.php" style="margin: 0 1rem;">Payment for employee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Settings.php" style="margin: 0 1rem;">Account Settings</a>
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

        <h2 class="text-center">Reserved Meeting Halls</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Hall Type</th>
                        <th>Hall ID</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Hall Price</th>
                        <th>Assigned By</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Table data will be dynamically inserted here -->
                </tbody>
            </table>
            <button id="calculatePriceBtn" class="btn btn-success mt-3">Calculate Total Price</button>
            <input type="hidden" id="totalPriceResult">
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
            if (!searchDate) {
                searchDate = document.getElementById('searchDate').value;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'searchReservedHalls.php?searchDate=' + searchDate, true);

            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('tableBody').innerHTML = this.responseText;
                }
            };

            xhr.send();
        }

        // Function to list all records
        function listAll() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'searchReservedHalls.php', true);

            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('tableBody').innerHTML = this.responseText;
                }
            };

            xhr.send();
        }

        // Function to calculate total price
        function calculateTotalPrice() {
            var tableBody = document.getElementById('tableBody');
            var rows = tableBody.getElementsByTagName('tr');
            var totalPrice = 0;

            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    // Get the hall price from the appropriate column (e.g., 5th column index 4)
                    var price = parseFloat(cells[4].innerText.replace(/[^0-9.-]/g, ''));
                    if (!isNaN(price)) {
                        totalPrice += price;
                    }
                }
            }

            document.getElementById('totalPriceResult').value = totalPrice.toFixed(2);
            alert('Total Price: $' + totalPrice.toFixed(2));
        }

        // Add event listener to the button
        document.getElementById('calculatePriceBtn').addEventListener('click', calculateTotalPrice);
    </script>
</body>
</html>
