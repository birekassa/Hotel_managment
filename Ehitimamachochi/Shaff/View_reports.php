<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "24770267";
$dbname = "ehms_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for an AJAX request with a search date
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_date'])) {
    $searchDate = $_POST['search_date'];
    $response = [];

    // Query to fetch report details by date and specific To_Which values
    $sql = "SELECT `report_provider`, `item_type`, `reported_date`, 
            item_name, item_measurement, item_quantity, item_single_price, item_total_price
            FROM `transferred_items`
            WHERE `To_Which` ='shaff' AND `reported_date` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchDate);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    $stmt->close();
    $conn->close();

    // Return response as JSON and exit
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shaff - View Reports</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem;">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="index.php">Shaff Panel</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Write_reports.php">Write Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="View_reports.php">View Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Settings.php">Account Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <label for="searchDate" class="me-2">Search By Date:</label>
                    <input type="date" id="searchDate" class="form-control d-inline-block" style="width: auto;">
                    <button class="btn btn-primary ms-2" onclick="searchByDate()">Search</button>
                </div>
            </div>

            <!-- Reports Table -->
            <div class="table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Measurement</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Reported Date</th>
                        </tr>
                    </thead>
                    <tbody id="reportTableBody">
                        <!-- Dynamic rows will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchByDate() {
            const date = document.getElementById('searchDate').value;
            const tableBody = document.getElementById('reportTableBody');

            if (!date) {
                alert("Please select a date to search.");
                return;
            }

            // AJAX request to fetch reports by date
            fetch(window.location.href, {  // Updated to use the current URL
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `search_date=${date}`
            })
            .then(response => response.json())
            .then(data => {
                // Clear previous results
                tableBody.innerHTML = "";

                // Populate the table with new data
                if (data.length > 0) {
                    data.forEach(report => {
                        const row = `<tr>
                            <td>${report.item_name}</td>
                            <td>${report.item_measurement}</td>
                            <td>${report.item_quantity}</td>
                            <td>${report.item_single_price}</td>
                            <td>${report.item_total_price}</td>
                            <td>${report.reported_date}</td>
                        </tr>`;
                        tableBody.innerHTML += row;
                    });
                } else {
                    tableBody.innerHTML = "<tr><td colspan='6'>No reports found for the selected date.</td></tr>";
                }
            })
            .catch(error => console.error("Error:", error));
        }
    </script>
</body>
</html>
