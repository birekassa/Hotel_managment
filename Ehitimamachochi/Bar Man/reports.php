<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .navbar {
            margin-bottom: 0;
            background-color: #343a40;
            height: 100px;
            align-items: center;
            gap: 10px;
        }

        .nav-item {
            margin: 10px;
        }

        .nav-item:hover {
            font-size: 17px;
            border-bottom: 1px blue solid;
            background-color: #333;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
        }

        .nav-link:hover {
            font-size: 18px;
        }

        .navbar-nav .nav-link.active {
            color: #ff5722 !important;
        }

        .navbar-nav {
            justify-content: center;
            /* Center-align the nav items */
            width: 100%;
            /* Ensure the ul takes full width to center items properly */
            gap: 10px;
        }

        .jumbotron {
            background-color: rgba(255, 255, 255, 0.9);
            color: black;
            font-family: 'Times New Roman', Times, serif;
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
            width: 100%;
            position: relative;
        }

        /* Center the buttons */
        .navbar .container-fluid {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .navbar-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        /* Style the hidden class */
        .hidden {
            display: none;
        }

        /* Comment item styles */
        .comment-item {
            background-color: rgb(85, 82, 82);
            border-radius: 10px;
            margin-bottom: 1rem;
            padding: 0.5rem;
            color: white;
        }

        .comment-item p {
            margin: 0;
        }

        .comment-item p:first-child {
            text-align: left;
        }

        .comment-item .date {
            font-size: 0.9rem;
            text-align: right;
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Bar-man panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="foods.php">Manage Food List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="beverages.php">Manage Beverage List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div>
    <h1>some reports sould be displayed for bar man</h1>
</div>


    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>