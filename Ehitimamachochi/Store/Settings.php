<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store_man/instock_items Page - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Internal CSS */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Times New Roman', Times, serif;
        }
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
        
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .list-group-item {
            cursor: pointer;
        }

    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">

    <div class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem; height: 100px;">
            <div class="container-xl h-100">
                <!-- Toggle button for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar content -->
                <a class="navbar-brand" href="index.php">Store Man Panel</a>
                <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php" style="margin: 0 1rem;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="instock_items.php" style="margin: 0 1rem;">In-Stock
                                Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="outstock_items.php" style="margin: 0 1rem;">Out-Stock
                                Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="reports.php" style="margin: 0 1rem;">Reports</a>
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
        <div class="container">
            <!-- Account Settings Content -->
            <div id="default_set" class="">
                <div class="section-header">
                    <button class="btn btn-link" onclick="goBack()">
                        <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
                    </button>
                    <h3 class="text-center flex-grow-1 mb-0">Account Settings</h3>
                </div>

                <a href="#" class="list-group-item list-group-item-action" onclick="toggleForm('change_username_form')">
                    <span><i class="bi bi-person-fill me-2"></i>Change Username</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action" onclick="toggleForm('change_password_form')">
                    <span><i class="bi bi-lock-fill me-2"></i>Change Password</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action" onclick="confirmLogout()">
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
                                <label for="new_username" class="form-label">New Username:</label>
                                <input type="text" id="new_username" name="new_username" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">Update</button>
                                <button type="reset" class="btn btn-secondary">Clear</button>
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
                                <label for="new_password" class="form-label">New Password:</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">Update</button>
                                <button type="reset" class="btn btn-secondary">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
        </script>

        <footer class="footer bg-dark text-white text-center py-4 mt-auto">
            <div class="container">
                <p style="margin: 0;">&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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