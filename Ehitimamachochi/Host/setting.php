<?php
// Include database connection
include '../assets/conn.php';
session_start(); // Start the session

// // Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//     header("Location: ../index/index.php"); // Redirect to login if not logged in
//     exit();
// }

// // Check if the user's position is 'casher' (case-insensitive)
// if (strtolower($_SESSION['position']) !== 'casher') {
//     header("Location: ../index/index.php"); // Redirect if not a 'casher'
//     exit();
// }
// ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host Management - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40; height: 100px;">
        <a class="navbar-brand" href="#" style="padding-left:20px;">Ehitimamachochi Hotel Host </a>
        <div class="container-xl h-100 d-flex align-items-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"
                style="border-color: white;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center w-100 bg-dark">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/New/Ehitimamachochi/Host/index.php" role="button"
                            aria-expanded="false" style="color: white !important;"> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="Available_Foods.php" class="nav-link"  id="" style="color: white !important; cursor:pointer;"> Available Foods </a>
                    </li>
                    <li class="nav-item">
                        <a href="Available_Beverages.php" class="nav-link" id="" style="color: white !important; cursor:pointer;"> Available Beverages</a>
                    </li>
                    <li class="nav-item">
                        <a href="AuthorizeCustomer.php" class="nav-link" id="" style="color: white !important; cursor:pointer;"> Authorize Customer </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="setting.php" role="button" style="color: white !important; cursor:pointer;"> Account Settings </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Account Settings Section -->
    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="text-center mb-4"><i class="bi bi-gear-fill me-2"></i>Account Settings</h2>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showSection('change_username')">
                <span><i class="bi bi-person-fill me-2"></i>Change Username</span><i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showSection('change_password')">
                <span><i class="bi bi-lock-fill me-2"></i>Change Password</span><i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="confirmLogout()">
                <span><i class="bi bi-box-arrow-right me-2"></i>Log out</span><i class="bi bi-chevron-right"></i>
            </a>
        </div>

        <!-- Change Username Section -->
        <div class="card mt-4" id="change_username" style="display:none;">
            <div class="card-body">
                <h3 class="card-title"><i class="bi bi-person-fill me-2"></i>Change Username</h3>
                <form action="change_username_process.php" method="post">
                    <div class="mb-3">
                        <label for="current_username" class="form-label">Current Username:</label>
                        <input type="text" id="current_username" name="current_username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password:</label>
                        <input type="password" id="current_password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_username" class="form-label">New Username:</label>
                        <input type="text" id="new_username" name="new_username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_username" class="form-label">Confirm New Username:</label>
                        <input type="text" id="confirm_username" name="confirm_username" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="submit" name="change_username" class="btn btn-success"><i class="bi bi-check-circle me-2"></i>Update</button>
                        <button type="reset" class="btn btn-secondary"><i class="bi bi-x-circle me-2"></i>Clear</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="card mt-4" id="change_password" style="display:none;">
            <div class="card-body">
                <h3 class="card-title"><i class="bi bi-lock-fill me-2"></i>Change Password</h3>
                <form action="change_password_process.php" method="post">
                    <div class="mb-3">
                        <label for="current_username" class="form-label">Current Username:</label>
                        <input type="text" id="current_username" name="current_username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password:</label>
                        <input type="password" id="current_password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password:</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="submit" name="change_password" class="btn btn-success"><i class="bi bi-check-circle me-2"></i>Change</button>
                        <button type="reset" class="btn btn-secondary"><i class="bi bi-x-circle me-2"></i>Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.card').forEach(card => card.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }
        
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "logout.php";
            }
        }
    </script>
</body>
</html>
