<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .navbar {
            margin-bottom: 0;
            background-color: #343a40;
            height: 100px;
            /* align-items: center; */
            gap: 10px;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .nav-link:hover {
            font-size: 18px;
        }

        .navbar-nav .nav-link.active {
            color: #ff5722 !important;
        }

        .navbar-nav {
            justify-content: center;
            /* Center-align the nav items */
            width: 100%;
            /* Ensure the ul takes full width to center items properly */
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
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand"  href="index.php">Bar-man panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="foods.php">Manage Food</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="manage beverages.php">Manage Beverage</a>
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

    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="text-center mb-4"><i class="bi bi-gear-fill me-2"></i>Account Settings</h2>

        <div id="set_option" class="list-group">
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="showSection('change_username')">
                <span><i class="bi bi-person-fill me-2"></i>Change Username</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="showSection('change_password')">
                <span><i class="bi bi-lock-fill me-2"></i>Change Password</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="confirmLogout(event)">
                <span><i class="bi bi-box-arrow-right me-2"></i>Log out</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>

        <!-- Change Username Section -->
        <div class="card" id="change_username" style="display:none;">
            <div class="card-body">
                <h3 class="card-title"><i class="bi bi-person-fill me-2"></i>Change Username</h3>
                <form action="change_username_process.php" method="post">
                    <div class="mb-3">
                        <label for="current_username" class="form-label">Current Username:</label>
                        <input type="text" id="current_username" name="current_username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password:</label>
                        <input type="password" id="current_password" name="current_password" class="form-control"
                            required>
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
                        <button type="submit" name="change_username" class="btn btn-success"><i
                                class="bi bi-check-circle me-2"></i>Update</button>
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
                        <input type="password" id="current_password" name="current_password" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password:</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                            required>
                    </div>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="submit" name="change_password" class="btn btn-success">
                            <i class="bi bi-check-circle me-2"></i>Change
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Clear
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        function showSection(id) {
            // Get all sections
            const sections = document.querySelectorAll('.card');

            // Hide all sections
            sections.forEach(section => {
                if (section.id !== id) {
                    section.style.display = 'none';
                }
            });

            // Toggle the selected section
            const selectedSection = document.getElementById(id);
            selectedSection.style.display = (selectedSection.style.display === 'none' || selectedSection.style.display === '') ? 'block' : 'none';
        }

        function confirmLogout(event) {
            event.preventDefault(); // Prevent the default link behavior

            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: 'Do you want to log out?',
                showCancelButton: true,
                confirmButtonText: 'Yes, log out',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the specified URL
                    window.location.href = "http://localhost/New/Ehitimamachochi%20hotel%20information%20managmnet%20System/index.php";
                }
            });
        }
    </script>

</body>

</html>