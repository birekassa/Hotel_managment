<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host Management - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- HTML and JavaScript -->
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40; height: 100px;">
        <a class="navbar-brand" href="#" style="padding-left: 20px;">Ehitimamachochi Hotel Host</a>
        <div class="container-xl h-100 d-flex align-items-center">
            <!-- Toggler Button for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"
                style="border-color: white;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Links (collapsed on small screens) -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-start w-100 bg-dark">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/New/Ehitimamachochi/Host/index.php" role="button"
                            aria-expanded="false" style="color: white !important;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="Available_Foods.php" class="nav-link" id="" style="color: white !important;">Available
                            Foods</a>
                    </li>
                    <li class="nav-item">
                        <a href="Available_Beverages.php" class="nav-link" id=""
                            style="color: white !important;">Available Beverages</a>
                    </li>
                    <li class="nav-item">
                        <a href="AuthorizeCustomer.php" class="nav-link" id=""
                            style="color: white !important;">Authorize Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="setting.php" role="button" style="color: white !important;">Account
                            Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Form for Authorize Customer -->
    <div class="container my-5">
        <h5 style="text-align: center; margin-bottom: 20px;">Authorize Customer Reservation</h5>
        <form action="Authorize_Customer.php" method="post"
            style="display: flex; flex-direction: column; gap: 15px; max-width: 600px; margin: 0 auto;">
            <div style="display: flex; flex-direction: column;">
                <label for="email" style="font-weight: bold;">Username:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required
                    style="padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <div style="display: flex; flex-direction: column;">
                <label for="password" style="font-weight: bold;">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required
                    style="padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
            </div>
            <div class="d-flex justify-content-between gap-2">
                <button type="submit" class="btn btn-success btn-lg" style="width:50%;">Submit</button>
                <button type="reset" class="btn btn-danger btn-lg" style="width:50%;">Reset</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>