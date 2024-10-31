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

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: none; /* Initially hidden */
        }

        .navbar {
            height: 100px;
        }

        .nav-item {
            margin: 10px;
        }

        .nav-item:hover {
            font-size: 17px;
            border-bottom: 1px blue solid;
            background-color: #333;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .btn-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10%;
        }

        .list-group-item {
            cursor: pointer;
        }

        .list-group-item .bi {
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem;">
        <div class="container-xl h-100">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">Shaff Panel</a>
            <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php" onclick="showSection('default_set')">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Write_reports.php">Write Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="View_reports.php">View Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Settings.php">Account Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Default Settings Menu -->
        <div id="default_set" class="card" style="display: block; margin: 20px;"> <!-- Show default set by default -->
            <div class="section-header">
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
        </div>

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
                        <label for="current_username_password" class="form-label">Current Username:</label>
                        <input type="text" id="current_username_password" name="current_username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="current_password_password" class="form-label">Current Password:</label>
                        <input type="password" id="current_password_password" name="current_password" class="form-control" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Show selected section and hide others
        function showSection(id) {
            document.querySelectorAll('.card').forEach(section => section.style.display = 'none');
            document.getElementById(id).style.display = 'block';
            document.getElementById('default_set').style.display = 'none';
        }

        // Go back to default settings menu
        function goBack() {
            document.querySelectorAll('.card').forEach(section => section.style.display = 'none');
            document.getElementById('default_set').style.display = 'block';
        }

        // Toggle visibility of forms
        function toggleForm(formId) {
            const form = document.getElementById(formId);
            if (form.style.display === 'block') {
                form.style.display = 'none';
            } else {
                goBack(); // Hide other forms before showing the selected form
                form.style.display = 'block';
            }
        }

        // Confirm logout action
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
