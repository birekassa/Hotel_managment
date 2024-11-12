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
//     $report_provider_name = 'ID: '.$id.',   Name : '.$f_name.' '.$l_name; // Combine first name, last name, and ID
// } else {
//     $report_provider_name = 'Unknown Provider'; // Fallback if no name or ID is found
// }

// // Close the statement and connection
// $stmt->close();
// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perchaser Page - Ehototmamachochi Hotel</title>
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="index.php">perchaser Panel</a>
                <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php" style="margin: 0 1rem;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="perchase.php" style="margin: 0 1rem;">Perchase
                                Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Reports.php" style="margin: 0 1rem;">View reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="settings.php" style="margin: 0 1rem;">Account
                                Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Container -->
        <div id="mainContainer" class="container mt-4">
            <div class="report-section container mt-5">
                <!-- Title Section -->
                <div class="text-center mb-4">
                    <h2 class="display-4 text-primary">Instocked Beverages Reports</h2>
                    <h5 class="text-muted">Search Reports by Reported Date</h5>
                </div>

                <!-- Search Form Section -->
                <div class="d-flex justify-content-center mb-4">
                    <form id="searchForm" method="GET" class="d-flex align-items-center">
                        <!-- Date Input Field -->
                        <input type="date" id="searchDate" name="date" class="form-control me-3 w-25" required>

                        <!-- Search Button -->
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-2"></i>Search
                        </button>
                    </form>
                </div>

                <!-- Reports Container (Dynamic content will be loaded here) -->
                <div id="reportsContainer" class="mt-4">
                    <!-- The content can be populated dynamically using JavaScript -->
                </div>
            </div>



            <footer class="footer bg-dark text-white text-center py-4 mt-auto">
                <div class="container">
                    <p style="margin: 0;">&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
                </div>
            </footer>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>