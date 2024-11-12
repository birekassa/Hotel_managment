<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <!-- Include external CSS and icons -->
    <?php include 'header_links.php'; ?>

    <style>
        /* Set global font family */
        * {
            font-family: 'Times New Roman', Times, serif;
        }

        /* Additional styling for html and body */
        html,
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Navbar styling */
        .navbar {
            background-color: #343a40; /* Dark background for navbar */
        }

        /* Navbar item styling */
        .navbar-nav .nav-link {
            font-size: 16px;
            margin-right: 15px;
            color: white; /* Set text color to white */
        }

        /* Active link color */
        .navbar-nav .nav-link.active {
            color: #f8f9fa; /* Light color when active */
        }

        /* Ensure navbar items are spaced well */
        .navbar-nav {
            background-color: #343a40; /* Dark background for navbar items */
            border-radius: 5px; /* Rounded corners for the background */
        }

        /* Adjust navbar on mobile devices */
        @media (max-width: 768px) {
            .navbar-nav .nav-link {
                font-size: 14px; /* Smaller font size on smaller screens */
            }

            .navbar-nav {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Navbar Brand with icon -->
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-house-door"></i> Bar-man Panel
            </a>
            <!-- Toggler Button for Small Screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="index.php"><i class="bi bi-house-door"></i> Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="view_beverages.php"><i class="bi bi-beer"></i> View Beverage</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="reports.php"><i class="bi bi-file-earmark-bar-graph"></i> Reports</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="settings.php"><i class="bi bi-gear"></i> Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->

    <!-- Include external JavaScript -->
    <?php include 'footer_scripts.php'; ?>
</body>

</html>
