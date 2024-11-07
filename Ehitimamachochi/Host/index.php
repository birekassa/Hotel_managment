<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host - Ehitimamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40; height: 100px;">
        <a class="navbar-brand" href="#" style="padding-left:20px;">Ehitimamachochi Hotel Host </a>
        <div class="container-xl h-100 d-flex align-items-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"
                style="border-color: white;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center w-100 bg-dark">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/New/Ehitimamachochi/Host/index.php" role="button"
                            aria-expanded="false" style="color: white !important;"> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="Available_Foods.php" class="nav-link"  id="" style="color: white !important; cursor:pointer;"> Available Foods </a>
                    </li>
                    <li class="nav-item">
                        <a href="Available_Beverages.php" class="nav-link" id="" style="color: white !important; cursor:pointer;"> Available Beverages</a>
                    </li>
                    <li class="nav-item">
                        <a href="AuthorizeCustomer.php" class="nav-link" id="" style="color: white !important; cursor:pointer;"> Authorize Customer </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="setting.php" role="button" style="color: white !important; cursor:pointer;"> Account Settings </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <div id="main_content" class="container mt-5">
        <div class="jumbotron py-5 px-5 rounded mx-3 mx-md-5" style="background-color: rgba(255, 255, 255, 0.9); color: black; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);">
            <h1 class="display-4 text-center font-weight-bold">Host Management Panel</h1>

            <!-- Dashboard Content -->
            <div class="container mt-4">
                <div class="row mb-4">
                    <!-- Dashboard cards here -->
                </div>
                <div class="row">
                    <!-- Add your content rows here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
