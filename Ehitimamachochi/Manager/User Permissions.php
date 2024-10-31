<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Permissions - Ehototmamachochi Hotel</title>
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

        .permissions-section {
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
                            <li><a class="dropdown-item" href="system_settings.html">System Settings</a></li>
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
        <div class="permissions-section mt-5">
            <h1 class="display-4 text-center font-weight-bold">User Permissions</h1>
            <p class="text-center">Manage and configure user permissions and roles for the system.</p>

            <!-- View Permissions -->
            <div class="permissions-section mt-5">
                <h2>View Permissions</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Role</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>Admin</td>
                            <td>Full Access</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Manager</td>
                            <td>Manage Inventory, View Reports</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            </td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>

            <!-- Edit Permissions -->
            <div class="permissions-section mt-5">
                <h2>Edit Permissions</h2>
                <form>
                    <div class="mb-3">
                        <label for="userSelect" class="form-label">Select User</label>
                        <select class="form-select" id="userSelect" aria-label="Select User">
                            <option selected>Select a user...</option>
                            <option value="1">John Doe</option>
                            <option value="2">Jane Smith</option>
                            <!-- Add more users as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">User Role</label>
                        <select class="form-select" id="userRole" aria-label="User Role">
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
