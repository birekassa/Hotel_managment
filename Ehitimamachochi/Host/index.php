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

// Set the timezone to East Africa Time (EAT)
$timezone = new DateTimeZone('Africa/Addis_Ababa');
$todayDate = (new DateTime('now', $timezone))->format('Y-m-d');

// SQL query to fetch activities for today
$sql = "SELECT item_name, item_type, item_quantity, item_price, 
        (item_quantity * item_price) AS Total_price, reported_date 
        FROM host_transaction
        WHERE DATE(reported_date) = ? 
        ORDER BY reported_date DESC 
        LIMIT 10";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $todayDate);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    $activities = [['error' => 'SQL Error: ' . $conn->error]];
} else {
    $activities = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $activities[] = $row;
        }
    } else {
        $activities = [['error' => 'No activities found.']];
    }
}

// Initialize total sales
$totalSales = array_sum(array_column($activities, 'Total_price'));

// Close connection
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
        <a class="navbar-brand" href="#" style="padding-left:20px;">Ehitimamachochi Hotel Host </a>
        <div class="container-xl h-100 d-flex align-items-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"
                style="border-color: white;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/New/Ehitimamachochi/Host/index.php" role="button"
                            aria-expanded="false" style="color: white !important;"> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#view_food_modal"
                            style="color: white !important; cursor:pointer;"> Available Foods
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="open_beverage_modal" style="color: white !important; cursor:pointer;">
                            Available Beverages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Authorize_Customer_btn"
                            style="color: white !important; cursor:pointer;">
                            Authorize Customer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="setting.php" role="button"
                            style="color: white !important; cursor:pointer;">
                            Account Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Main Content -->
    <div style="flex: 1; padding-left: 0;" id="main_content" style="display:flex;">
        <div class="jumbotron mt-5 py-5 px-5 rounded mx-3 mx-md-5"
            style="background-color: rgba(255, 255, 255, 0.9); color: black; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);">
            <div class="container">
                <h1 class="display-4 text-center font-weight-bold">Host Management Panel</h1>
                <!-- Dashboard Content -->
                <div class="container" style="margin-top: 20px;">
                    <div class="row mb-4">
                        <!-- Dashboard cards here -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-white bg-primary">
                                    <h2>Your Today's Activities</h2>
                                </div>
                                <div class="card-body">
                                    <table id="activitiesTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($activities[0]['error'])): ?>
                                                <tr>
                                                    <td colspan="6">Error: <?= htmlspecialchars($activities[0]['error']) ?>
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($activities as $activity): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($activity['item_name']) ?></td>
                                                        <td><?= htmlspecialchars($activity['item_type']) ?></td>
                                                        <td><?= htmlspecialchars($activity['item_quantity']) ?></td>
                                                        <td><?= htmlspecialchars($activity['item_price']) ?></td>
                                                        <td><?= htmlspecialchars($activity['Total_price']) ?></td>
                                                        <td><?= htmlspecialchars($activity['reported_date']) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <!-- Button to trigger the sales display -->
                                    <button onclick="displayTotalSales()"
                                        style="margin-top: 10px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                        Calculate Today's Sales
                                    </button>
                                    <!-- Paragraph to hold the total result (hidden by default) -->
                                    <p id="total_result" style="display:none;"><?php echo $totalSales; ?></p>
                                    <script>
                                        // JavaScript function to display the total sales
                                        function displayTotalSales() {
                                            var totalResult = document.getElementById('total_result').textContent;
                                            // Display SweetAlert with the total sales
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Your Result',
                                                text: "Today's Total Sales: " + totalResult,
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="view_food_modal" tabindex="-1" aria-labelledby="viewFoodModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewFoodModalLabel">View Food List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
            </div>
        </div>
    </div>

    <!-- List Beverage Items Modal -->
    <div class="modal fade" id="view_beverage_modal" tabindex="-1" aria-labelledby="viewBeverageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 0;">
                <div class="modal-header" style="position: relative;">
                    <h5 class="modal-title" id="viewBeverageModalLabel">View Beverage List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 0; height: calc(100% - 60px); overflow-y: auto;">
                    <div class="d-flex justify-content-around mb-3" style="padding: 20px;">
                        <button id="alcohol_beverage_btn" class="btn btn-primary" style="width: 40%;">Alcohol
                            Beverage</button>
                        <button id="soft_beverage_btn" class="btn btn-secondary" style="width: 40%;">Soft
                            Beverage</button>
                    </div>
                    <!-- Soft Beverage Content -->
                    <div id="soft_beverage_modal" class="modal-content" style="display: none;">
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
                                    // Fetch Soft Beverage items
                                    $stmt = $pdo->query("SELECT item_name, quantity, price FROM table_beverages WHERE category='soft-drink'");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['item_name']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['price']) . '</td>';
                                        echo '<td><button class="btn btn-success reserve-btn" data-item="' . htmlspecialchars($row['item_name']) . '" data-category="soft_drink" data-quantity="' . htmlspecialchars($row['quantity']) . '" data-price="' . htmlspecialchars($row['price']) . '">Reserve</button></td>';
                                        echo '</tr>';
                                    }
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Alcohol Beverage Content -->
                    <div id="alcohol_beverage_modal" class="modal-content" style="display: none;">
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
                                // Fetch Alcohol Beverage items
                                $stmt = $pdo->query("SELECT item_name, quantity, price FROM table_beverages WHERE category='alcohol-drink'");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($row['item_name']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
                                    echo '<td>' . htmlspecialchars($row['price']) . '</td>';
                                    echo '<td><button class="btn btn-success reserve-btn" data-item="' . htmlspecialchars($row['item_name']) . '" data-category="alcohol_drink" data-quantity="' . htmlspecialchars($row['quantity']) . '" data-price="' . htmlspecialchars($row['price']) . '">Reserve</button></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for Authorize Customer -->
    <div id="Authorize_Customer_modal" class="modal"
        style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-content"
            style="background-color: #fff; margin: 10% auto; padding: 20px; border-radius: 5px; width: 80%; max-width: 600px; position: relative;">
            <div class="modal-header" style="border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 20px;">
                <h5 style="margin: 0; text-align:cenetr;">Authorize Customer Reservation</h5>
                <span onclick="document.getElementById('Authorize_Customer_modal').style.display='none';"
                    style="position: absolute; top: 10px; right: 10px; color: #ff6f61; font-size: 34px; font-weight: bold; cursor: pointer;">
                    <i class="bi bi-x"></i>
                </span>
            </div>
            <div class="modal-body">
                <form action="Authorize_Customer.php" method="post"
                    style="display: flex; flex-direction: column; gap: 15px;">
                    <div style="display: flex; flex-direction: column;">
                        <label for="email" style="font-weight: bold;">username:</label>
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
        </div>
    </div>
</body>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ensure SweetAlert2 is loaded before any logic runs
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 is not loaded. Ensure SweetAlert2 script is included.');
            return;
        }

        // Toggle between Fast Food and Food tabs
        document.getElementById('fast_food_btn').addEventListener('click', function () {
            document.getElementById('fast_food_modal').style.display = 'block';
            document.getElementById('food_modal').style.display = 'none';
        });
        document.getElementById('food_btn').addEventListener('click', function () {
            document.getElementById('food_modal').style.display = 'block';
            document.getElementById('fast_food_modal').style.display = 'none';
        });

        // Toggle between Alcohol Beverage and Soft Beverage tabs
        document.getElementById('alcohol_beverage_btn').addEventListener('click', function () {
            document.getElementById('alcohol_beverage_modal').style.display = 'block';
            document.getElementById('soft_beverage_modal').style.display = 'none';
        });
        document.getElementById('soft_beverage_btn').addEventListener('click', function () {
            document.getElementById('soft_beverage_modal').style.display = 'block';
            document.getElementById('alcohol_beverage_modal').style.display = 'none';
        });

        // Initialize Soft Beverage modal as default view
        document.getElementById('soft_beverage_modal').style.display = 'block';
        document.getElementById('alcohol_beverage_modal').style.display = 'none';

        // Show beverage modal when button is clicked
        document.getElementById('open_beverage_modal').addEventListener('click', function () {
            var modal = new bootstrap.Modal(document.getElementById('view_beverage_modal'));
            modal.show();
        });

        // Select all elements with the class 'reserve-btn'
        const reserveButtons = document.querySelectorAll('.reserve-btn');
        reserveButtons.forEach(button => {
            button.addEventListener('click', () => handleReservation(button));
        });

        // Open Authorize Customer modal
        const openModal = document.getElementById('Authorize_Customer_btn');
        const authorizeCustomerModal = document.getElementById('Authorize_Customer_modal');
        openModal.addEventListener('click', function () {
            authorizeCustomerModal.style.display = 'block';
        });
    });

    // Function to handle the reservation button click
    function handleReservation(button) {
        const itemName = button.dataset.item;
        const category = button.dataset.category;
        const price = button.dataset.price;
        reserveItem(itemName, category, price);
    }

    // Function to reserve an item with prompt and SweetAlert2 for feedback
    function reserveItem(itemName, category, price) {
        const quantity = prompt("Enter the quantity to reserve:");
        if (quantity > 0) {
            // Prepare reservation details
            const reservationDetails = {
                item_name: itemName,
                category: category,
                quantity: quantity,
                price: price,
                reported_date: new Date().toISOString().split('T')[0] // Format as YYYY-MM-DD
            };

            // Send reservation details to the server
            fetch('reservation_process.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(reservationDetails)
            })
                .then(response => response.json())
                .then(data => {
                    // Show success or error message using SweetAlert2
                    Swal.fire(
                        data.success ? 'Reserved!' : 'Error!',
                        data.success ? `${itemName} has been successfully reserved.` : 'There was an issue reserving the item. Please try again.',
                        data.success ? 'success' : 'error'
                    );
                })
                .catch(error => {
                    console.error('Reservation error:', error);
                    Swal.fire('Error!', 'An unexpected error occurred. Please try again.', 'error');
                });
        } else {
            alert("Please enter a valid quantity greater than 0!");
        }
    }


    // Show or hide specific sections
    function showSection(id) {
        document.querySelectorAll('.card').forEach(section => {
            section.style.display = section.id === id ? 'block' : 'none';
        });
    }

    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        const mainContent = document.getElementById('main_content');
        if (section.style.display === 'none' || section.style.display === '') {
            section.style.display = 'block';
            mainContent.style.display = 'none';
        } else {
            section.style.display = 'none';
            mainContent.style.display = 'block';
        }
    }
</script>


<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>