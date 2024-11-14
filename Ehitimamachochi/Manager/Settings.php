
<?php
// Function to get hotel information from hotel_config.json
function getHotelInfo(){
    $filePath = '../assets/hotel_config.json'; // Adjust path if needed

    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        if ($jsonData === false) {
            echo "Error: Unable to read the configuration file.";
            return null;
        }

        $data = json_decode($jsonData, true);
        if ($data === null) {
            echo "Error: Failed to decode JSON data.";
            return null;
        }

        return $data;
    } else {
        echo "Error: Configuration file not found.";
        return null;
    }
}

// Function to update the hotel name in hotel_config.json
function updateHotelInfo($newName,$newAddress ,$newPhone,$newEmail)
{
    $filePath = '../assets/hotel_config.json';
    $data = getHotelInfo();

    if ($data) {
        $data['name'] = $newName; // Update the hotel name
        $data['location'] = $newAddress; // Update the hotel Adress
        $data['phone'] = $newPhone; // Update the hotel phone
        $data['email'] = $newEmail; // Update the hotel Email


        // Save the updated data back to the JSON file
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}

// Initialize a success message variable
$successMessage = "";

// Check if form is submitted via POST to update the hotel name
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newName'])) {
    $newName = $_POST['newName'];
    $newAddress = $_POST['newAddress'];
    $newPhone = $_POST['newPhone'];
    $newEmail = $_POST['newEmail'];
    updateHotelInfo($newName,$newAddress ,$newPhone,$newEmail);

    // Set the success message to be displayed
    $successMessage = "Hotel Information updated successfully!";
}

// Get the current hotel information
$currentHotelInfo = getHotelInfo();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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

        .hidden {
            display: none;
        }

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
    <!-- Main Container -->
    <div class="container my-4">
        <!-- Success Alert (conditionally displayed) -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($successMessage); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Section for System Settings -->
        <section id="systemSettings" class="collapse show">
            <div class="section-header">System Settings</div>
            <div class="list-group shadow-sm rounded">
                <!-- Change Hotel Name Section -->
                <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#changeNameSection">
                    <i class="bi bi-pencil-square me-2"></i> Change Hotel Name
                </a>
                <div id="changeNameSection" class="collapse">
                    <div class="card card-body border-0">
                        <h2 style="text-align: center;">New Hotel Information</h2>
                        <form method="POST" action="">
                            <div class="row g-3">
                                <!-- Column 1 -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="newName" class="form-label">New Hotel Name</label>
                                        <input type="text" id="newName" name="newName" class="form-control"
                                            value="<?php echo htmlspecialchars($currentHotelInfo['name']); ?>" required>
                                    </div>
                                </div>    
                                <!-- Column 2 -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="newAddress" class="form-label">New Hotel Address</label>
                                        <input type="text" id="newAddress" name="newAddress" class="form-control"
                                            value="<?php echo htmlspecialchars($currentHotelInfo['location']); ?>" required>
                                    </div>
                                </div>

                                <!-- Column 1 -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="newPhone" class="form-label">New Hotel Phone</label>
                                        <input type="text" id="newPhone" name="newPhone" class="form-control" value="<?php echo htmlspecialchars($currentHotelInfo['phone']); ?>"
                                            required>
                                    </div>
                                </div>

                                <!-- Column 2 -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="newEmail" class="form-label">New Hotel Email</label>
                                        <input type="email" id="newEmail" name="newEmail" class="form-control" value="<?php echo htmlspecialchars($currentHotelInfo['email']); ?>"
                                            required>
                                    </div>
                                </div>

                                <!-- Submit Buttons -->
                                <div class="col-12 d-flex justify-content-center gap-10">
                                    <div class="mb-3 col-12 col-md-4 d-flex justify-content-center gap-3">
                                        <button type="reset" class="btn btn-secondary w-100">Clear</button>
                                        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- Change Room Image Section -->
                <a class="list-group-item list-group-item-action" data-bs-toggle="collapse" href="#changeImageSection">
                    <i class="bi bi-house-door-fill me-2"></i> Change Image for Beds
                </a>
                <div id="changeImageSection" class="collapse">
                    <div class="card card-body border-0">
                        <div class="row g-3">
                            <!-- Standard Room Button -->
                            <div class="col-12 col-md-6">
                                <button class="btn btn-primary w-100 fs-5 fw-bold" onclick="selectImage('Standard Room')">Standard Room</button>
                            </div>
                            <!-- Deluxe Room Button -->
                            <div class="col-12 col-md-6">
                                <button class="btn btn-primary w-100 fs-5 fw-bold" onclick="selectImage('Deluxe Room')">Deluxe Room</button>
                            </div>
                            <!-- Suite Room Button -->
                            <div class="col-12 col-md-6">
                                <button class="btn btn-primary w-100 fs-5 fw-bold" onclick="selectImage('Suite Room')">Suite Room</button>
                            </div>
                            <!-- Luxury Room Button -->
                            <div class="col-12 col-md-6">
                                <button class="btn btn-primary w-100 fs-5 fw-bold" onclick="selectImage('Luxury Room')">Luxury Room</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Change Hall Image Section -->
                <a class="list-group-item list-group-item-action" data-bs-toggle="collapse"
                    href="#changeHallImageSection">
                    <i class="bi bi-building me-2"></i> Change Image for Halls
                </a>
                <div id="changeHallImageSection" class="collapse">
                    <div class="card card-body border-0">
                        <div class="d-grid gap-2">
                            <!-- just this should be displayed in two column and should dispalyed in attractive way -->
                            <button class="btn btn-primary">Standard Hall</button>
                            <button class="btn btn-primary">Deluxe Hall</button>
                            <button class="btn btn-primary">Suite Hall</button>
                            <button class="btn btn-primary">Luxury Hall</button>
                        </div>
                    </div>
                </div>


                <a href="off_system.php" class="list-group-item list-group-item-action">
                    <i class="bi bi-power me-2"></i> Switch System
                </a>
            </div>
            <!-- Section for Account Settings -->
            <div id="accountSettings">
                <div class="section-header">Account Settings</div>
                <p>Account-related settings will go here.</p>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>