<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Page - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="asset/index.css">
</head>

<body style="font-family: 'Times New Roman', Times, serif;">

    <div class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem; height: 100px;">
            <div class="container-xl h-100">
                <!-- Toggle button for mobile view -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar content -->
                <a class="navbar-brand" href="index.php">Casher panel</a>
                <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php" style="margin: 0 1rem;"
                                onclick="showSection('defaultSection')">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Reports.php" style="margin: 0 1rem;">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="payment.php" style="margin: 0 1rem;">Pay Salary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Settings.php" style="margin: 0 1rem;">Account
                                Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="container mt-4">
            <div class="row g-5 justify-content-center">
            <h1 style="display:flex; justify-content:center;">Activities</h1>
                
                <!-- Card 2 -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header" style="background-color:green;color:white;">
                            Previous Month Total Income
                        </div>
                        <div class="card-body">
                            <p>this is on constraction</p>
                        </div>
                    </div>
                </div>
                <!-- Card 1 -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header" style="background-color:#333;color:white;">
                            Net Profit 
                        </div>
                        <div class="card-body">
                            <p>this is on constraction</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer class="footer bg-dark text-white text-center py-4 mt-auto">
            <div class="container">
                <p style="margin: 0;">&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    </script>
</body>

</html>