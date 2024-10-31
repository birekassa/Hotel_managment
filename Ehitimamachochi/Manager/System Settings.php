<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings - Ehototmamachochi Hotel</title>
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

        .settings-section {
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
                        <a class="nav-link" href="Dashboard.php">
                            <i class="bi bi-house-door me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Overview.php">
                            <i class="bi bi-grid me-2"></i>Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="View Inventory.php">
                            <i class="bi bi-list-ul me-2"></i>View Inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="View Staff.php">
                            <i class="bi bi-person me-2"></i>View Staff
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Assign Roles.php">
                            <i class="bi bi-person-badge me-2"></i>Assign Roles
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="System Settings.php">System Settings</a></li>
                            <li><a class="dropdown-item" href="Account Settings.php">Account Settings</a></li>
                            <li><a class="dropdown-item" href="Log out.php">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="settings-section mt-5">
            <h1 class="display-4 text-center font-weight-bold">System Settings</h1>
            <p class="text-center">Configure the system settings, manage user permissions, and update application configurations.</p>

            <!-- General Settings -->
            <div class="settings-section mt-5">
                <h2>General Settings</h2>
                <form>
                    <div class="mb-3">
                        <label for="siteName" class="form-label">Site Name</label>
                        <input type="text" class="form-control" id="siteName" placeholder="Enter site name">
                    </div>
                    <div class="mb-3">
                        <label for="siteEmail" class="form-label">Site Email</label>
                        <input type="email" class="form-control" id="siteEmail" placeholder="Enter site email">
                    </div>
                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Contact Number</label>
                        <input type="tel" class="form-control" id="contactNumber" placeholder="Enter contact number">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <!-- User Management -->
            <div class="settings-section mt-5">
                <h2>User Management</h2>
                <form>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">Default User Role</label>
                        <select class="form-select" id="userRole" aria-label="Default User Role">
                            <option selected>Choose a role...</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userPermissions" class="form-label">User Permissions</label>
                        <textarea class="form-control" id="userPermissions" rows="4" placeholder="Enter user permissions..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Permissions</button>
                </form>
            </div>

            <!-- System Configurations -->
            <div class="settings-section mt-5">
                <h2>System Configurations</h2>
                <form>
                    <div class="mb-3">
                        <label for="systemLanguage" class="form-label">System Language</label>
                        <select class="form-select" id="systemLanguage" aria-label="System Language">
                            <option selected>Choose a language...</option>
                            <option value="en">English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <!-- Add more languages as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="timezone" class="form-label">Timezone</label>
                        <select class="form-select" id="timezone" aria-label="Timezone">
                            <option selected>Choose a timezone...</option>
                            <option value="UTC">UTC</option>
                            <option value="America/New_York">America/New York</option>
                            <option value="Europe/London">Europe/London</option>
                            <option value="Asia/Tokyo">Asia/Tokyo</option>
                            <!-- Add more timezones as needed -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Configurations</button>
                </form>
            </div>
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
