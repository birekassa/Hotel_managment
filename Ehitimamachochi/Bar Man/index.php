<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Management - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            /* background: url('bar_background.jpg') no-repeat center center fixed;
            background-size: cover; */
            margin: 0;
        }

        .navbar {
            margin-bottom: 0;
            background-color: #343a40;
            height: 100px;
            align-items: center;
            gap: 10px;
        }


        .navbar-nav {
            flex-direction: row;
        }

        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            font-size: 18px;
        }

        .nav-item {
            margin: 10px;
        }

        .nav-item:hover {
            font-size: 17px;
            border-bottom: 1px blue solid;
            background-color: #333;
        }

        .jumbotron {
            background-color: rgba(255, 255, 255, 0.9);
            color: black;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .jumbotron img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Bar-man panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="foods.php">Manage Food</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="manage beverages.php">Manage Beverage</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="reports.php">Reports</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="Settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <main class="container">
        <div class="jumbotron py-5 px-4 ">
            <div class="text-center" style="margin:0px;">
                <h2>Welcome to the Bar Management System</h2>
                <img src="https://th.bing.com/th/id/R.21d709538db479c09c2e8095a585ec92?rik=PneWsnYtlxGBtw&pid=ImgRaw&r=0"
                    alt="Bar Management" class="img-fluid rounded shadow " style="width:1000px; height:400px;">
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Ehototmamachochi Hotel. All rights reserved. Powered by MTU Department of SE Group 1 Members</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>