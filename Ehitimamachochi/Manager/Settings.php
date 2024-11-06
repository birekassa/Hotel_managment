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
                <span class="d-flex align-items-center"><i class="bi bi-tools me-2"></i>System Settings</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="showSection('account_settings')">
                <span class="d-flex align-items-center"><i class="bi bi-person-gear me-2"></i>Account Settings</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>

        <!-- System Settings Content -->
        <div id="system_settings" class="card d-none">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="#" class="btn btn-link me-3" onclick="goBack()">
                    <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
                </a>
                <h3 class="text-center flex-grow-1">System Settings</h3>
            </div>

            <!-- Change Hotel Name -->
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                data-bs-toggle="modal" data-bs-target="#changeNameModal">
                <span><i class="bi bi-pencil-square me-2"></i>Change Name of Hotel</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <!-- Hotel Name Modal -->
            <div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="changeNameModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changeNameModalLabel">Change Hotel Name</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="changeNameForm">
                                <div class="mb-3">
                                    <label for="newName" class="form-label">Please Enter New Name</label>
                                    <input type="text" class="form-control" id="newName" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveNameBtn">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Room Images -->
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                data-bs-toggle="modal" data-bs-target="#changeImageModal">
                <span><i class="bi bi-house-door-fill me-2"></i>Change Image for Beds</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <!-- Room Image Modal -->
            <div class="modal fade" id="changeImageModal" tabindex="-1" aria-labelledby="changeImageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changeImageModalLabel">Change Room Images</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" onclick="changeImage('standard')">Change Standard Room Image</button>
                                <button class="btn btn-primary" onclick="changeImage('deluxe')">Change Deluxe Room Image</button>
                                <button class="btn btn-primary" onclick="changeImage('suite')">Change Suite Room Image</button>
                                <button class="btn btn-primary" onclick="changeImage('luxury')">Change Luxury Room Image</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Hall Images -->
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                data-bs-toggle="modal" data-bs-target="#changeHallImageModal">
                <span><i class="bi bi-building me-2"></i>Change Image for Halls</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <!-- Hall Image Modal -->
            <div class="modal fade" id="changeHallImageModal" tabindex="-1" aria-labelledby="changeHallImageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changeHallImageModalLabel">Change Hall Images</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" onclick="changeHallImage('standard')">Change Standard Hall Image</button>
                                <button class="btn btn-primary" onclick="changeHallImage('deluxe')">Change Deluxe Hall Image</button>
                                <button class="btn btn-primary" onclick="changeHallImage('suite')">Change Suite Hall Image</button>
                                <button class="btn btn-primary" onclick="changeHallImage('luxury')">Change Luxury Hall Image</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Off System for Employee -->
            <a href="off_system.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-power me-2"></i>Off System for Employee</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>

        <!-- Account Settings Content -->
        <div id="account_settings" class="card d-none">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="#" class="btn btn-link me-3" onclick="goBack()">
                    <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
                </a>
                <h3 class="text-center flex-grow-1">Account Settings</h3>
            </div>

            <!-- Change Username -->
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="toggleForm('change_username_form')">
                <span><i class="bi bi-person-fill me-2"></i>Change Username</span>
                <i class="bi bi-chevron-right"></i>
            </a>

            <!-- Change Password -->
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="toggleForm('change_password_form')">
                <span><i class="bi bi-lock-fill me-2"></i>Change Password</span>
                <i class="bi bi-chevron-right"></i>
            </a>

            <!-- Logout -->
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="confirmLogout()">
                <span><i class="bi bi-box-arrow-right me-2"></i>Log Out</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>

    <script>
        function showSection(id) {
            document.querySelectorAll('.card').forEach(section => section.classList.add('d-none'));
            document.getElementById(id).classList.remove('d-none');
            document.getElementById('default_set').classList.add('d-none');
        }

        function goBack() {
            document.querySelectorAll('.card').forEach(section => section.classList.add('d-none'));
            document.getElementById('default_set').classList.remove('d-none');
        }

        function toggleForm(formId) {
            const form = document.getElementById(formId);
            form.classList.toggle('d-none');
        }

        function confirmLogout() {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: 'You will be logged out.',
                showCancelButton: true,
                confirmButtonText: 'Yes, log out',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        }

        function changeImage(roomType) {
            // Implement your image upload logic here
            Swal.fire({
                icon: 'success',
                title: 'Image upload started',
                text: `Uploading image for ${roomType} room...`,
                timer: 2000,
                showConfirmButton: false
            });
        }

        function changeHallImage(hallType) {
            // Implement your image upload logic here
            Swal.fire({
                icon: 'success',
                title: 'Image upload started',
                text: `Uploading image for ${hallType} hall...`,
                timer: 2000,
                showConfirmButton: false
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
