<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
       /* Internal CSS */
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
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

        .navbar-nav .nav-link {
            color: white !important;
            font-size: 1rem;
            text-decoration: none;
            padding: 10px;
        }

        .container {
            max-width: 600px;
            margin-top: 100px;
        }

        .card {
            display: none;
        }

        .list-group-item {
            cursor: pointer;
        }

        .list-group-item .bi {
            font-size: 1.2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .section-header button {
            margin-left: 1rem;
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

    <div class="container">
        <!-- Default Settings Menu -->
        <div id="default_set">
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="showSection('system_settings')">
                <span style="justify-content:cenetr;"><i class="bi bi-tools me-2"></i>System Settings</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="showSection('account_settings')">
                <span style="justify-content:cenetr;"><i class="bi bi-person-gear me-2"></i>Account Settings</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>

        <!-- System Settings Content -->
        <div id="system_settings" class="card">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="#" class="btn btn-link me-3" onclick="goBack()">
                        <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
                    </a>
                <h3 style="text-align: center; flex: 1;">System Settings</h3>
            </div>

            <a href="" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-pencil-square me-2"></i>Change Name of Hotel </span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-image me-2"></i>change image for foods</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-image me-2"></i>change image for beverages</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-house-door-fill me-2"></i>Change image for beds</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-building me-2"></i>change image for halls</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="off_system.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-power me-2"></i>Off System for Employee</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>

        <!-- Account Settings Content -->
        <div id="account_settings" class="card">
            <div class="section-header d-flex align-items-center">
                    <a href="#" class="btn btn-link me-3" onclick="goBack()">
                        <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
                    </a>
                <h3 class="flex-grow-1 text-center mb-0">Account Settings</h3>
            </div>


            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="toggleForm('change_username_form')">
                <span><i class="bi bi-person-fill me-2"></i>Change Username</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="toggleForm('change_password_form')">
                <span><i class="bi bi-lock-fill me-2"></i>Change Password</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="confirmLogout()">
                <span><i class="bi bi-box-arrow-right me-2"></i>Log out</span>
                <i class="bi bi-chevron-right"></i>
            </a>

            <!-- Change Username Form -->
            <div id="change_username_form" class="card">
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

            <!-- Change Password Form -->
            <div id="change_password_form" class="card">
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
                            <button type="submit" name="change_password" class="btn btn-success"><i class="bi bi-check-circle me-2"></i>Update</button>
                            <button type="reset" class="btn btn-secondary"><i class="bi bi-x-circle me-2"></i>Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showSection(id) {
            document.querySelectorAll('.card').forEach(section => section.style.display = 'none');
            document.getElementById(id).style.display = 'block';
            document.getElementById('default_set').style.display = 'none';
        }

        function goBack() {
            document.querySelectorAll('.card').forEach(section => section.style.display = 'none');
            document.getElementById('default_set').style.display = 'block';
        }

        function toggleForm(formId) {
            const form = document.getElementById(formId);
            form.style.display = form.style.display === 'block' ? 'none' : 'block';
        }

        function confirmLogout() {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: 'Do you want to log out?',
                showCancelButton: true,
                confirmButtonText: 'Yes, log out',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "http://localhost/New/Ehitimamachochi/index/index.php";
                }
            });
        }
    </script>
</body>

</html>
