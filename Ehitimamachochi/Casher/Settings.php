<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="asset/setting.css" class="css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem; height: 100px;">
        <div class="container-xl h-100">
            <!-- Toggle button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar content -->
            <a class="navbar-brand" href="index.php">Casher panel</a>
            <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                    <!-- Navbar items -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php" style="margin: 0 1rem;">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Reports.php" style="margin: 0 1rem;">Reports</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-white" href="payment.php" style="margin: 0 1rem;">Pay Salary</a> 
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Settings.php" style="margin: 0 1rem;">Account Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="text-center mb-4"><i class="bi bi-gear-fill me-2"></i>Account Settings</h2>

        <section id="set_option" class="list-group">
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
        </section>

        <!-- Change Username Section -->
        <section class="card mt-4" id="change_username" style="display:none;">
            <div class="card-body">
                <div class="section-header">
                    <h3 class="card-title"><i class="bi bi-person-fill me-2"></i>Change Username</h3>
                    <i class="bi bi-arrow-left back-arrow" onclick="showSection('')"></i>
                </div>
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
        </section>

        <!-- Change Password Section -->
        <section class="card mt-4" id="change_password" style="display:none;">
            <div class="card-body">
                <div class="section-header">
                    <h3 class="card-title"><i class="bi bi-lock-fill me-2"></i>Change Password</h3>
                    <i class="bi bi-arrow-left back-arrow" onclick="showSection('')"></i>
                </div>
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
        </section>
    </div>
    <footer class="footer bg-dark text-white text-center py-4" style="margin-top: auto;">
        <div class="container">
            <p style="margin: 0;">&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
        </div>
    </footer>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showSection(id) {
            // Get all sections
            const sections = document.querySelectorAll('section.card');

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
                    window.location.href = "http://localhost/New/Ehitimamachochi/index/index.php";
                }
            });
        }
    </script>
</html>