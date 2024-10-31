<?php
$servername = "localhost";
$username = "root";
$password = "24770267";
$dbname = "ehms_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get today's date
$today = date('Y-m-d');

// Fetch sales data for today
$sales_sql = "SELECT s.sales_id, i.item_name, s.quantity_sold, s.unit_price, s.total_price, s.sale_date
              FROM sales s
              JOIN inventory i ON s.item_id = i.id
              WHERE s.sale_date = ?";
$stmt = $conn->prepare($sales_sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$sales_result = $stmt->get_result();

// Fetch stock levels
$stock_sql = "SELECT id, item_name, category, quantity, status
              FROM inventory";
$stock_result = $conn->query($stock_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 0;
            background-color: #343a40;
        }
        .navbar-nav .nav-link {
            color: white !important;
        }
        .report-section {
            margin: 2rem 0;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: relative;
            bottom: 0;
        }
        .table-responsive {
            margin-top: 2rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="Dashboard.php">
                            <i class="bi bi-house-door me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Overview.php">
                            <i class="bi bi-grid me-2"></i>Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="View Inventory.php">
                            <i class="bi bi-list-ul me-2"></i>View Inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Daily Report.php">
                            <i class="bi bi-bar-chart-line me-2"></i>Daily Report
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Staff Details.php">
                            <i class="bi bi-person me-2"></i>Staff Details
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="Account Settings.php">Account Settings</a></li>
                            <li><a class="dropdown-item" href="System Settings.php">System Settings</a></li>
                            <li><a class="dropdown-item" href="Log out.php">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="report-section mt-5">
            <h1 class="display-4 text-center font-weight-bold">Daily Report</h1>
            <p class="text-center">Review the daily sales and stock levels for today.</p>

            <!-- Sales Summary -->
            <div class="table-responsive">
                <h3>Sales Summary</h3>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Item Name</th>
                            <th>Quantity Sold</th>
                            <th>Unit Price</th>
                            <th>Total Sales</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $sales_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['sales_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity_sold']); ?></td>
                                <td>$<?php echo number_format($row['unit_price'], 2); ?></td>
                                <td>$<?php echo number_format($row['total_price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($row['sale_date']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Stock Levels -->
            <div class="table-responsive mt-4">
                <h3>Stock Levels</h3>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Quantity Available</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stock_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['category']); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                <td>
                                    <?php if ($row['quantity'] > 10): ?>
                                        <span class="badge bg-success">In Stock</span>
                                    <?php elseif ($row['quantity'] > 0): ?>
                                        <span class="badge bg-warning">Low Stock</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Out of Stock</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Ehototmamachochi Hotel. All rights reserved. Powered by MTU Department of SE Group 1 Members</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close connection
$stmt->close();
$conn->close();
?>
