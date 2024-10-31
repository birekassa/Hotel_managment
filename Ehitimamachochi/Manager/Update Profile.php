<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - Ehototmamachochi Hotel</title>
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

        .profile-section {
            margin: 2rem 0;
        }

        .profile-section img {
            max-width: 150px;
            border-radius: 50%;
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

        .toggle-section {
            cursor: pointer;
            color: #007bff;
            text-decoration: underline;
            margin-top: 20px;
        }

        .toggle-section:hover {
            color: #0056b3;
        }

        .form-section {
            display: none;
            margin-top: 20px;
        }

        .form-section.active {
            display: block;
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
                            <li><a class="dropdown-item" href="Account Settings">Account Settings</a></li>
                            <li><a class="dropdown-item" href="Log out.php">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="profile-section mt-5">
            <h1 class="display-4 text-center font-weight-bold">Update Profile</h1>

            <!-- Profile Picture -->
            <div class="text-center mb-4">
                <img src="https://via.placeholder.com/150" alt="Profile Picture">
                <form>
                    <div class="mb-3">
                        <label for="profilePic" class="form-label">Upload New Profile Picture</label>
                        <input class="form-control" type="file" id="profilePic">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Picture</button>
                </form>
            </div>

            <!-- Privacy and Security -->
            <div class="toggle-section" id="togglePrivacy">
                Privacy and Security
            </div>
            <div class="form-section" id="privacySection">
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Change Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter new username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Change Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter new password">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>

            <!-- Change Times -->
            <div class="toggle-section" id="toggleTimes">
                Change Times
            </div>
            <div class="form-section" id="timesSection">
                <form>
                    <div class="mb-3">
                        <label for="checkinTime" class="form-label">Check-In Time</label>
                        <input type="time" class="form-control" id="checkinTime" value="14:00">
                    </div>
                    <div class="mb-3">
                        <label for="checkoutTime" class="form-label">Check-Out Time</label>
                        <input type="time" class="form-control" id="checkoutTime" value="12:00">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Times</button>
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
    <script>
        document.getElementById('togglePrivacy').addEventListener('click', function() {
            document.getElementById('privacySection').classList.toggle('active');
        });

        document.getElementById('toggleTimes').addEventListener('click', function() {
            document.getElementById('timesSection').classList.toggle('active');
        });
    </script>
</body>

</html>
