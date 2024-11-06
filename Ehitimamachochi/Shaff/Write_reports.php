<?php
// Include database connection
include '../assets/conn.php';
session_start(); // Start the session

// // Check if the user's position is 'casher'
// if ($_SESSION['position'] !== 'casher' && $_SESSION['position'] !== 'Casher') {
//     // Redirect to login page if the user is not a 'casher'
//     header("Location: ../index/index.php");
//     exit();
// }

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../index/index.php");
    exit();
}

$position = $_SESSION['position'];
$report_provider_name = ''; // Initialize variable

// Prepare and execute statement to fetch first name, last name, and ID number based on the username
$stmt = $conn->prepare("SELECT f_name, l_name, id FROM employees WHERE username = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($f_name, $l_name, $id);
$stmt->fetch();

// Check if names and ID were retrieved successfully
if ($f_name && $l_name && $id) {
    $report_provider_name = 'ID: ' . $id . ',   Name : ' . $f_name . ' ' . $l_name; // Combine first name, last name, and ID
} else {
    $report_provider_name = 'Unknown Provider'; // Fallback if no name or ID is found
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Report - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .nav-item {
            font-size: 16px;
        }

        .nav-item:hover {
            border-bottom: 1px solid blue;
        }

        .report-section {
            margin-top: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: gray;
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">
    <div class="d-flex flex-column min-vh-100">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem; height: 100px;">
            <div class="container-xl h-100">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="index.php">Shaff Panel</a>
                <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                        <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="Write_reports.php">Write Reports</a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-white" href="View_reports.php">View Reports</a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-white" href="Settings.php">Account Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Category Buttons -->
        <section id="Category_btn" class="my-3">
            <div class="d-flex justify-content-center" style="gap: 10%; text-align: center; margin: top 30px;">
                <button class="w_r btn"
                    style="width: 400px; height: 200px; position: relative; border: none; background-color: blue;color :white; overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;"
                    onclick="loadFoodItems('fast_food')">
                    <h1>Fast Food</h1>
                    <span class="tooltip"
                        style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); background: rgba(0, 0, 0, 0.7); color: white; padding: 5px 10px; border-radius: 5px; display: none;">Fast
                        Food</span>
                </button>

                <button class="w_r btn"
                    style="width: 400px; height: 200px; position: relative; border: none; background-color: blue; color :white; overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;"
                    onclick="loadFoodItems('food')">
                    <h1>Normal Foods</h1>
                    <span class="tooltip"
                        style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); background: rgba(0, 0, 0, 0.7); color: white; padding: 5px 10px; border-radius: 5px; display: none;">Normal
                        Food</span>
                </button>
            </div>
        </section>

        <script>
            // Show tooltip on hover
            document.querySelectorAll('.w_r').forEach(button => {
                button.addEventListener('mouseenter', function () {
                    this.querySelector('.tooltip').style.display = 'block';
                    this.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.5)';
                    this.style.transform = 'scale(1.05)';
                    this.querySelector('img').style.transform = 'scale(1.1)'; // Slightly scale the image
                });

                button.addEventListener('mouseleave', function () {
                    this.querySelector('.tooltip').style.display = 'none';
                    this.style.boxShadow = 'none';
                    this.style.transform = 'scale(1)';
                    this.querySelector('img').style.transform = 'scale(1)'; // Reset image scale
                });
            });
        </script>

        <!-- Write Reports Section (hidden by default) -->
        <section id="WriteReports" class="container-fluid report-section" style="display: none;">
            <button onclick="goBack()" class="btn btn-secondary mb-3" aria-label="Go back to category selection">
                <i class="fas fa-arrow-left"></i> Back
            </button>
            <h2 style="text-align:center; margin-bottom :20px;"> ለየ አንዳዱ የ ምግብ አይንት የተጠቀምናቸው ግባቶች እና መጠናችው</h2>
            <form action="submit_report.php" method="post">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <label for="report_provider" class="me-2">your name:</label>
                        <input type="text" class="form-control" name="report_provider" id="report_provider"
                            value="<?php echo htmlspecialchars($report_provider_name); ?>" readonly required>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="report_type" class="me-2">Report Type:</label>
                        <select name="report_type" id="report_type" required>
                            <option value="" selected>Select report type</option>
                            <option value="fast_food">Fast Food</option>
                            <option value="normal_food">Normal Food</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="reported_date" class="me-2">Date:</label>
                        <input type="date" class="form-control" name="reported_date" id="reported_date" required>
                    </div>
                </div>
                <table id="reportTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name of Foods</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <td colspan="3" class="text-center">Select a report type to load data...</td>
                        </tr>
                    </tbody>
                </table>
                <div class="button-container">
                    <button style="width: 40%;" type="submit" class="btn btn-primary">Submit</button>
                    <button style="width: 40%;" type="reset" class="btn btn-danger">Clear</button>
                </div>
            </form>
        </section>

        

        <script>
            // Show the Write Reports section when a category button is clicked
            document.querySelectorAll('.w_r').forEach(button => {
                button.addEventListener('click', function () {
                    document.getElementById("WriteReports").style.display = 'block';
                    document.getElementById("Category_btn").style.display = 'none';
                });
            });
            document.getElementById('reported_date').max = new Date().toISOString().split("T")[0];


            function loadFoodItems(category) {
                const tableBody = document.querySelector('#tableBody');
                tableBody.innerHTML = '<tr><td colspan="3" class="loading">Loading...</td></tr>';

                fetch(`fetch_foods.php?category=${category}`)
                    .then(response => response.json())
                    .then(data => populateTableRows(data))
                    .catch(error => {
                        console.error('Error fetching food items:', error);
                        tableBody.innerHTML = '<tr><td colspan="3" class="text-center text-danger">Failed to load items</td></tr>';
                    });
            }

            function populateTableRows(data) {
                const tableBody = document.querySelector('#tableBody');
                tableBody.innerHTML = '';
                data.forEach(item => {
                    const row = document.createElement('tr');
                    // First cell with item name
                    const itemNameCell = document.createElement('td');
                    itemNameCell.textContent = item.item_name;
                    row.appendChild(itemNameCell);
                    // Create input cells for each header (except the first one)
                    const headerCount = document.querySelectorAll('#reportTable thead th').length;
                    for (let i = 1; i < headerCount; i++) {
                        const inputCell = document.createElement('td');
                        const input = document.createElement('input');
                        input.type = 'number'; // Input type can be adjusted as needed
                        input.className = 'form-control'; // Add Bootstrap styling
                        input.placeholder = `Default Not used`; // Placeholder for clarity
                        inputCell.appendChild(input);
                        row.appendChild(inputCell);
                    }
                    tableBody.appendChild(row);
                });
            }

            function goBack() {
                // Hide the Write Reports section and show the category buttons
                document.getElementById("WriteReports").style.display = 'none';
                document.getElementById("Category_btn").style.display = 'block'; // Show category buttons again
            }

            // Call fetchHeaders on page load
            window.onload = function () {
                fetchHeaders();
            };

            function fetchHeaders() {
                const headerRow = document.querySelector('#reportTable thead tr');
                headerRow.innerHTML = '<th>Name of Foods</th>';
                const tableBody = document.querySelector('#tableBody');
                tableBody.innerHTML = '<tr><td colspan="3" class="loading">Loading headers...</td></tr>';

                fetch(`fetch_headers.php?fetchHeaders=1`)
                    .then(response => response.json())
                    .then(headers => {
                        headers.forEach(header => {
                            const th = document.createElement('th');
                            th.textContent = header;
                            headerRow.appendChild(th);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching headers:', error);
                        tableBody.innerHTML = '<tr><td colspan="3" class="text-center text-danger">Failed to load headers</td></tr>';
                    });
            }
        </script>

        <!-- Footer -->
        <footer class="footer bg-dark text-white text-center py-4 mt-auto">
            <div class="container">
                <p style="margin: 0;">&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>