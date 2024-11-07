<?php
// Start session and include database connection
session_start();
include '../assets/conn.php';

// Uncomment the lines below to enforce 'casher' role and login check
// if (!isset($_SESSION['username']) || strtolower($_SESSION['position']) !== 'casher') {
//     header("Location: ../index/index.php");
//     exit();
// }

// Set the timezone to East Africa Time (EAT) and get today's date
$timezone = new DateTimeZone('Africa/Addis_Ababa');
$todayDate = (new DateTime('now', $timezone))->format('Y-m-d');

// Fetch today's transactions
$sql = "SELECT item_name, item_type, item_quantity, item_price, 
        (item_quantity * item_price) AS Total_price, reported_date 
        FROM host_transaction
        WHERE DATE(reported_date) = ? 
        ORDER BY reported_date DESC 
        LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $todayDate);
$stmt->execute();
$result = $stmt->get_result();

$activities = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
$totalSales = array_sum(array_column($activities, 'Total_price'));

$stmt->close();
$conn->close();
?>


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
        <!-- <a class="navbar-brand" href="#" style="padding-left:20px;">Ehitimamachochi Hotel Host </a> -->
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



    <!-- Food List Modal -->
    <div class="container my-4">
        <h2 style="text-align:centetr;">FOOD LIST</h2>
                <div class="d-flex justify-content-around mb-3" style="padding: 20px;">
                    <button id="fast_food_btn" class="btn btn-primary" style="width: 40%;">FAST FOOD</button>
                    <button id="food_btn" class="btn btn-secondary" style="width: 40%;">FOOD</button>
                </div>
                <!-- Fast Food Content -->
                <div id="fast_food_modal" class="modal-content" style="display: block;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Include database connection
                            include '../assets/conn.php';
                            try {
                                $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                // Fetch Fast Food items
                                $stmt = $pdo->query("SELECT item_name, quantity, price FROM table_foods WHERE category='fast_food'");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['item_name']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['price']) . '</td>';
                                    echo '<td><button class="btn btn-success reserve-btn" data-item="' . htmlspecialchars($row['item_name']) . '" data-category="fast_food" data-quantity="' . htmlspecialchars($row['quantity']) . '" data-price="' . htmlspecialchars($row['price']) . '">Reserve</button></td>';
                                    echo '</tr>';
                                }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Food Content -->
                <div id="food_modal" class="modal-content" style="display: none;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch Food items
                            $stmt = $pdo->query("SELECT item_name, quantity, price FROM table_foods WHERE category='food'");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['item_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['price']) . '</td>';
                                echo '<td><button class="btn btn-success reserve-btn" data-item="' . htmlspecialchars($row['item_name']) . '" data-category="food" data-quantity="' . htmlspecialchars($row['quantity']) . '" data-price="' . htmlspecialchars($row['price']) . '">Reserve</button></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Quantity Input Modal -->
<div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reserveModalLabel">Reserve Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <p id="item_name_modal">Item: </p>
                <p id="item_price_modal">Price: </p>
                <p id="item_quantity_modal">Available Quantity: </p>
                <div class="form-group">
                    <label for="quantityInput">Enter Quantity:</label>
                    <input type="number" id="quantityInput" class="form-control" min="1" placeholder="Enter quantity">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="reserveItemBtn">Reserve</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('fast_food_btn').addEventListener('click', () => toggleModal('fast_food'));
            document.getElementById('food_btn').addEventListener('click', () => toggleModal('food'));

            document.querySelectorAll('.reserve-btn').forEach(button => {
                button.addEventListener('click', () => reserveItem(button.dataset));
            });
        });

        function toggleModal(category) {
            document.getElementById('fast_food_modal').style.display = category === 'fast_food' ? 'block' : 'none';
            document.getElementById('food_modal').style.display = category === 'food' ? 'block' : 'none';
        }

        function reserveItem({ item, category, price }) {
            const quantity = prompt("Enter the quantity to reserve:");
            if (quantity > 0) {
                fetch('reservation_process.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ item_name: item, category, quantity, price, reported_date: new Date().toISOString().split('T')[0] })
                })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire(data.success ? 'Reserved!' : 'Error!', data.message, data.success ? 'success' : 'error');
                    })
                    .catch(error => {
                        console.error('Reservation error:', error);
                        Swal.fire('Error!', 'An unexpected error occurred.', 'error');
                    });
            } else {
                alert("Please enter a valid quantity greater than 0!");
            }
        }
    </script>
</body>

</html>