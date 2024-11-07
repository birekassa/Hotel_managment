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

// $position = $_SESSION['position'];
// $report_provider_name = ''; // Initialize variable

// // Prepare and execute statement to fetch first name, last name, and ID number based on the username
// $stmt = $conn->prepare("SELECT f_name, l_name, id FROM employees WHERE username = ?");
// if (!$stmt) {
//     die("Prepare failed: " . $conn->error);
// }

// $stmt->bind_param("s", $username);
// $stmt->execute();
// $stmt->bind_result($f_name, $l_name, $id);
// $stmt->fetch();

// // Check if names and ID were retrieved successfully
// if ($f_name && $l_name && $id) {
//     $report_provider_name = 'ID: ' . $id . ',   Name : ' . $f_name . ' ' . $l_name; // Combine first name, last name, and ID
// } else {
//     $report_provider_name = 'Unknown Provider'; // Fallback if no name or ID is found
// }

// // Close the statement and connection
// $stmt->close();
// $conn->close();
// ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="asset/report.css" class="css">
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
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="index.php">Home</a>
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



<div class="content">
    <!-- Main Container Section (Visible only on page load and when back is clicked) -->
    <div id="mainContainer" class="container-fluid d-flex justify-content-center align-items-center" style="height: 60vh; width: 100vh;" >
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showIstockedSection()">
                <span><i class="bi bi-file-earmark-text me-2"></i>View Instocked Item Reports from store</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showSoldSection()">
                <span><i class="bi bi-pencil me-2"></i> View Sold Item Reports </span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>

    <!-- Container for Instocked Beverage Information (Initially Hidden) -->
    <div id="instockedSection" class="container" style="display: none;">
        <!-- Back Button -->
        <button onclick="showMainContainer()" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back
        </button>
        <h1>INSTOCKED BEVERAGE INFORMATION</h1>
        <div>
            <input type="text" placeholder="Search by name or date" id="searchInput">
            <button onclick="searchBeverage()">Search</button>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <button onclick="loadNextDay()" id="nextDayButton" class="btn btn-primary">Previous Page</button>
            <button onclick="loadPreviousDay()" class="btn btn-primary">Next Page</button>
        </div>
        <div class="table-responsive">
            <table class="table" style="width:100%; margin-bottom:30px;">
                <thead>
                    <tr>
                        <th>Beverage Name</th>
                        <th>Beverage Type</th>
                        <th>Measurement</th>
                        <th>Quantity</th>
                        <th>Date Added</th>
                        <th>Added By</th>
                    </tr>
                </thead>
                <tbody id="beverageTableBody"></tbody>
            </table>
        </div>
    </div>

    <!-- Container for Sold Beverage Information (Initially Hidden) -->
    <div id="soldSection" class="container" style="display: none;">
        <!-- Back Button -->
        <button onclick="showMainContainer()" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back
        </button>
        <h1>Sold Beverage Information</h1>
        <div>
            <input type="text" placeholder="Search by name or date" id="searchInput">
            <button onclick="searchBeverage()">Search</button>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <button onclick="loadNextDay()" id="nextDayButton" class="btn btn-primary">Previous Page</button>
            <button onclick="loadPreviousDay()" class="btn btn-primary">Next Page</button>
        </div>
        <div class="table-responsive">
            <table class="table" style="width:100%; margin-bottom:30px;">
                <thead>
                    <tr>
                        <th>Beverage Name</th>
                        <th>Beverage Type</th>
                        <th>Quantity Sold</th>
                        <th>Date Sold</th>
                        <th>Other Info</th>
                    </tr>
                </thead>
                <tbody id="soldBeverageTableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Function to show the main container and hide other sections
function showMainContainer() {
    // Show the main container and hide both sections
    document.getElementById('mainContainer').style.display = 'flex';  // Show main container (centered)
    document.getElementById('instockedSection').style.display = 'none'; // Hide instocked section
    document.getElementById('soldSection').style.display = 'none'; // Hide sold section
}

// Function to show the Instocked Section and hide others
function showIstockedSection() {
    // Hide the main container and show the instocked section
    document.getElementById('mainContainer').style.display = 'none'; // Hide main container
    document.getElementById('instockedSection').style.display = 'block'; // Show instocked section
    document.getElementById('soldSection').style.display = 'none'; // Hide sold section
}

// Function to show the Sold Section and hide others
function showSoldSection() {
    // Hide the main container and show the sold section
    document.getElementById('mainContainer').style.display = 'none'; // Hide main container
    document.getElementById('instockedSection').style.display = 'none'; // Hide instocked section
    document.getElementById('soldSection').style.display = 'block'; // Show sold section
}
</script>




    <script>

        // Get the current date
        let currentDate = new Date();
        const nextDayButton = document.getElementById('nextDayButton');

        // Function to search for beverages
        function searchBeverage() {
            let searchValue = document.getElementById('searchInput').value;

            fetch('fetch_beverages.php')
                .then(response => response.json())
                .then(data => {
                    let filteredData = data.filter(item =>
                        item.beverage_name.toLowerCase().includes(searchValue.toLowerCase()) ||
                        item.added_at.includes(searchValue)
                    );
                    populateTable(filteredData);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Function to format date as YYYY-MM-DD
        function formatDate(date) {
            let year = date.getFullYear();
            let month = (date.getMonth() + 1).toString().padStart(2, '0');
            let day = date.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Function to load data for the previous day
        function loadPreviousDay() {
            currentDate.setDate(currentDate.getDate() - 1);
            fetchDataForDate(currentDate);
            nextDayButton.disabled = false; // Enable "Next Day" button
        }

        // Function to load data for the next day
        function loadNextDay() {
            currentDate.setDate(currentDate.getDate() + 1);

            let today = new Date();
            if (formatDate(currentDate) >= formatDate(today)) {
                currentDate = today;
                nextDayButton.disabled = true; // Disable "Next Day" button if today is reached
            }

            fetchDataForDate(currentDate);
        }

        // Function to fetch and display data for a specific date
        function fetchDataForDate(date) {
            let formattedDate = formatDate(date);
            console.log("Fetching data for:", formattedDate);

            fetch('fetch_beverages.php')
                .then(response => response.json())
                .then(data => {
                    let filteredData = data.filter(item => item.added_at.includes(formattedDate));
                    if (filteredData.length === 0 && date < new Date()) {
                        // If no data, go to the previous day
                        loadPreviousDay();
                    } else {
                        populateTable(filteredData);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Function to populate the table with data
        function populateTable(data) {
            const tableBody = document.getElementById('beverageTableBody');
            tableBody.innerHTML = ''; // Clear existing rows

            data.forEach(item => {
                let row = `<tr>
                <td>${item.beverage_name}</td>
                <td>${item.beverage_type}</td>
                <td>${item.measurement}</td>
                <td>${item.beverage_quantity}</td>
                <td>${item.added_at}</td>
                <td>${item.added_by}</td>
            </tr>`;
                tableBody.innerHTML += row;
            });
        }

        // Initialize by loading today's data or the most recent available data
        fetchDataForDate(currentDate);
    </script>


    <footer class="footer bg-dark text-white text-center py-4" style="margin-top: auto;">
        <div class="container">
            <p style="margin: 0;">&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>