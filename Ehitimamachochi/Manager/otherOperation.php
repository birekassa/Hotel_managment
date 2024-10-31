<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
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
        .navbar {
            margin-bottom: 20px; /* Adjust the margin as needed */
        }
        .list-group-item {
            cursor: pointer;
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

    <div class="container-fluid">
        <div id="set_option" class="list-group">
            <a href="attendance.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showSection('attendance')">
                <span><i class="bi bi-person-fill me-2"></i> Take Attendance</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="view attendance.php" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showSection('view-attendance')">
                <span><i class="bi bi-eye-fill me-2"></i> View Attendance</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" onclick="showSection('pay')">
                <span><i class="bi bi-cash-coin me-2"></i> approve request</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        function showSection(section) {
            // Implement functionality to show and hide sections based on the 'section' argument
            console.log('Show section:', section);
        }
    </script>
</body>
</html>
