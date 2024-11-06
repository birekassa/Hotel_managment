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
    $report_provider_name = 'ID: '.$id.',   Name : '.$f_name.' '.$l_name; // Combine first name, last name, and ID
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
    <title>perchaser Page - Ehototmamachochi Hotel</title>
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

        /* Additional styling for the report section */
        .report-section {
            margin-top: 20px;
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">

    <div class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem; height: 100px;">
            <div class="container-xl h-100">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="index.php">perchaser Panel</a>
                <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php" style="margin: 0 1rem;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="perchase.php" style="margin: 0 1rem;">Perchase
                                Items</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Reports.php" style="margin: 0 1rem;">View reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="settings.php" style="margin: 0 1rem;">Account
                                Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Container -->
        <div id="mainContainer" class="container mt-4">
            <div class="report-section">
                <h2> This is Instocked Beverages reports</h2>
                <h5>Search Reports by Reported Date</h5>
                <form id="searchForm" method="GET">
                    <input type="date" id="searchDate" name="date" class="form-control d-inline-block w-25" required>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <div id="reportsContainer" class="mt-4">
                    <?php
                   //include database connection
                    include '../assets/conn.php';
                    try {
                        // Create a new PDO instance
                        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Get the date from the query string
                        $date = $_GET['date'] ?? date('Y-m-d'); // Default to today's date if not provided
                    
                        // Prepare the SQL statement
                        $stmt = $pdo->prepare("SELECT report_provider, report_type, item_name, measurement, quantity, single_price, total_price, reported_date FROM wechi WHERE reported_date = :reported_date AND report_type = 'beverages'");
                        $stmt->bindParam(':reported_date', $date);

                        // Execute the statement
                        $stmt->execute();
                        $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Check if reports are found
                        if ($reports) {
                            // Start table structure
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Item Name</th>';
                            echo '<th>Report Provider</th>';
                            echo '<th>Type</th>';
                            echo '<th>Measurement</th>';
                            echo '<th>Quantity</th>';
                            echo '<th>Single Price</th>';
                            echo '<th>Total Price</th>';
                            echo '<th>Reported Date</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            foreach ($reports as $report) {
                                echo '<tr>';
                                echo "<td>{$report['item_name']}</td>";
                                echo "<td>{$report['report_provider']}</td>";
                                echo "<td>{$report['report_type']}</td>";
                                echo "<td>{$report['measurement']}</td>";
                                echo "<td>{$report['quantity']}</td>";
                                echo "<td>{$report['single_price']}</td>";
                                echo "<td>{$report['total_price']}</td>";
                                echo "<td>{$report['reported_date']}</td>";
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<p>No reports found for this date.</p>';
                        }
                    } catch (Exception $e) {
                        echo '<p class="text-danger">Error fetching reports: ' . htmlspecialchars($e->getMessage()) . '</p>';
                    } finally {
                        // Close the connection
                        $pdo = null;
                    }
                    ?>
                </div>
            </div>
            <div class="report-section">
                <h2> This is Instocked Other Expenditure reports</h2>
                <h5>Search Reports by Reported Date</h5>
                <form id="searchForm" method="GET">
                    <input type="date" id="searchDate" name="date" class="form-control d-inline-block w-25" required>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <div id="reportsContainer" class="mt-4">
                    <?php
                    //include database connection
                    include '../assets/conn.php';

                    try {
                        // Create a new PDO instance
                        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Get the date from the query string
                        $date = $_GET['date'] ?? date('Y-m-d'); // Default to today's date if not provided
                    
                        // Prepare the SQL statement
                        $stmt = $pdo->prepare("SELECT report_provider, report_type, item_name, measurement, quantity, single_price, total_price, reported_date FROM wechi WHERE reported_date = :reported_date AND report_type = 'other_expenditure'");
                        $stmt->bindParam(':reported_date', $date);

                        // Execute the statement
                        $stmt->execute();
                        $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Check if reports are found
                        if ($reports) {
                            // Start table structure
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Item Name</th>';
                            echo '<th>Report Provider</th>';
                            echo '<th>Type</th>';
                            echo '<th>Measurement</th>';
                            echo '<th>Quantity</th>';
                            echo '<th>Single Price</th>';
                            echo '<th>Total Price</th>';
                            echo '<th>Reported Date</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            foreach ($reports as $report) {
                                echo '<tr>';
                                echo "<td>{$report['item_name']}</td>";
                                echo "<td>{$report['report_provider']}</td>";
                                echo "<td>{$report['report_type']}</td>";
                                echo "<td>{$report['measurement']}</td>";
                                echo "<td>{$report['quantity']}</td>";
                                echo "<td>{$report['single_price']}</td>";
                                echo "<td>{$report['total_price']}</td>";
                                echo "<td>{$report['reported_date']}</td>";
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<p>No reports found for this date.</p>';
                        }
                    } catch (Exception $e) {
                        echo '<p class="text-danger">Error fetching reports: ' . htmlspecialchars($e->getMessage()) . '</p>';
                    } finally {
                        // Close the connection
                        $pdo = null;
                    }
                    ?>
                </div>
            </div>
        </div>

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