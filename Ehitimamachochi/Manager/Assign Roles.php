<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Roles - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .navbar {
            margin-bottom: 0;
            background-color: #343a40;
        }

        .navbar-nav .nav-link {
            color: white !important;
        }

        .assign-roles-section {
            margin: 2rem 0;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: relative;
            bottom: 0;
        }

        .form-control, .btn {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="bi bi-house-door me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="overview.php">
                            <i class="bi bi-grid me-2"></i>Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_inventory.php">
                            <i class="bi bi-list-ul me-2"></i>View Inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_staff.php">
                            <i class="bi bi-person me-2"></i>View Staff
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="assign_roles.php">
                            <i class="bi bi-person-badge me-2"></i>Assign Roles
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="Account Settings.php">Account Settings</a></li>
                            <li><a class="dropdown-item" href="System Settings.php">System Settings</a></li>
                            <li><a class="dropdown-item" href="localhost/new/Ehototmamachochi/index/index.php">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="assign-roles-section mt-5">
            <h1 class="display-4 text-center font-weight-bold">Assign Roles</h1>
            <p class="text-center">Select a staff member and assign or update their role.</p>

            <!-- Assign Role Form -->
            <form>
                <div class="mb-3">
                    <label for="staffSelect" class="form-label">Select Staff Member</label>
                    <select class="form-select" id="staffSelect" aria-label="Select Staff Member">
                        <option selected>Choose a staff member...</option>
                        <option value="1">John Doe</option>
                        <option value="2">Jane Smith</option>
                        <!-- Add more staff members as needed -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="roleSelect" class="form-label">Assign Role</label>
                    <select class="form-select" id="roleSelect" aria-label="Assign Role">
                        <option selected>Choose a role...</option>
                        <option value="Manager">Manager</option>
                        <option value="Bartender">Bartender</option>
                        <option value="Waiter">Waiter</option>
                        <!-- Add more roles as needed -->
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Assign Role</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Ehototmamachochi Hotel. All rights reserved. Powered by MTU Department of SE Group 1 Members</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
