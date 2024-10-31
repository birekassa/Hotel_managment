<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; margin: 0; padding: 0;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 20px;">
        <a class="navbar-brand" href="#">Hotel Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container" style="margin-top: 20px;">
        <!-- Key Metrics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card" style="border: 1px solid #ddd;">
                    <div class="card-header" style="background-color: #007bff; color: white; font-weight: bold;">Available Rooms</div>
                    <div class="card-body" style="background-color: #ffffff; padding: 20px; text-align: center;">
                        <div style="font-size: 2rem; color: #007bff;">25</div>
                        <div style="font-size: 1.5rem; font-weight: bold;">Rooms</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border: 1px solid #ddd;">
                    <div class="card-header" style="background-color: #007bff; color: white; font-weight: bold;">Occupied Rooms</div>
                    <div class="card-body" style="background-color: #ffffff; padding: 20px; text-align: center;">
                        <div style="font-size: 2rem; color: #007bff;">10</div>
                        <div style="font-size: 1.5rem; font-weight: bold;">Rooms</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border: 1px solid #ddd;">
                    <div class="card-header" style="background-color: #007bff; color: white; font-weight: bold;">Total Reservations</div>
                    <div class="card-body" style="background-color: #ffffff; padding: 20px; text-align: center;">
                        <div style="font-size: 2rem; color: #007bff;">150</div>
                        <div style="font-size: 1.5rem; font-weight: bold;">Reservations</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border: 1px solid #ddd;">
                    <div class="card-header" style="background-color: #007bff; color: white; font-weight: bold;">Total Revenue</div>
                    <div class="card-body" style="background-color: #ffffff; padding: 20px; text-align: center;">
                        <div style="font-size: 2rem; color: #007bff;">$30,000</div>
                        <div style="font-size: 1.5rem; font-weight: bold;">Revenue</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="border: 1px solid #ddd;">
                    <div class="card-header" style="background-color: #007bff; color: white; font-weight: bold;">Recent Activities</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" style="border: none; border-bottom: 1px solid #ddd;">Room 101 booked by John Doe - <span style="color: #6c757d;">2 hours ago</span></li>
                            <li class="list-group-item" style="border: none; border-bottom: 1px solid #ddd;">Inventory updated - <span style="color: #6c757d;">5 hours ago</span></li>
                            <li class="list-group-item" style="border: none; border-bottom: 1px solid #ddd;">Employee shift change - <span style="color: #6c757d;">1 day ago</span></li>
                            <li class="list-group-item" style="border: none; border-bottom: 1px solid #ddd;">New reservation created - <span style="color: #6c757d;">2 days ago</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
