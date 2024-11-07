<?php
// Include database connection
include '../assets/conn.php';
session_start(); // Start the session

// // Check if the user's position is 'Manager'
// if ($_SESSION['position'] !== 'Manager' && $_SESSION['position'] !== 'manager') {
//     // Redirect to login page if the user is not a 'manager'
//     header("Location: ../index/index.php");
//     exit();
// }

// // Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//     // Redirect to login page if not logged in
//     header("Location: ../index/index.php");
//     exit();
// }

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Panel - Ehototmamachochi Hotel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Internal CSS */
        html,
        body {
            height: 100%;
            flex-direction: column;
            font-family: 'Times New Roman', Times, serif;
        }

        .content {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }

        .navbar-nav .nav-link::after {
            content: '';
            display: block;
            height: 2px;
            background-color: white;
            width: 0;
            position: absolute;
            left: 0;
            bottom: 0;
            transition: width 0.3s;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        .navbar {
            height: 100px;
            margin-top: 1rem;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark position-relative" style="background-color: #343a40;">
        <div class="container-xl">
            <a class="navbar-brand" href="#" style="padding-left: 10px;">Manager Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"
                    style="display: flex; justify-content: center; flex-grow: 1;">
                    <!-- Home Dropdown -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-house-door me-2"></i>Home
                        </a>
                    </li>
                    <!-- Manage Inventory -->
                    <li class="nav-item">
                        <a class="nav-link" href="inventory/manageInventory.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-boxes me-2"></i>Manage Inventory
                        </a>
                    </li>
                    <!-- Manage Employee -->
                    <li class="nav-item">
                        <a class="nav-link" href="employee/manage_employees.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-person-badge me-2"></i>Manage Employee
                        </a>
                    </li>
                    <!-- Sales Reports -->
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-bar-chart-line me-2"></i>Reports
                        </a>
                    </li>
                    <!-- Other Operations -->
                    <li class="nav-item">
                        <a class="nav-link" href="otherOperation.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-tools me-2"></i>Other Operations
                        </a>
                    </li>
                    <!-- Settings -->
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container content">
        <!-- Manager Sections -->
        <div class="container my-4">
            <h2>Show Today's expense , Income and Profit</h2>
            <div class="row">
                <!-- Profit Cards -->
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Today's expense</div>
                        <div class="card-body">
                            <p id="wechi" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Income</div>
                        <div class="card-body">
                            <p id="gebi" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Today's Profit</div>
                        <div class="card-body">
                            <p id="tirf" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manager Sections -->
        <div class="container my-4">
            <h2>Show Prediction of Profit</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Profit After a Week</div>
                        <div class="card-body">
                            <p id="weeklyProfit" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Profit After a Month</div>
                        <div class="card-body">
                            <p id="monthlyProfit" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Profit After a Year</div>
                        <div class="card-body">
                            <p id="yearlyProfit" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer
        style="padding: 30px; background-color: #333; color: #f8f9fa; text-align: center; font-family: 'Times New Roman', serif; font-size: 14px; border-top: 3px solid #00c8ff;">
        <p style="margin: 0; line-height: 1;">
            &copy; 2024 EHOTOTMAMACHOCHI HOTEL. All rights reserved.<br>Powered by MTU Department of SE Group 1
            Members
        </p>
    </footer>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>