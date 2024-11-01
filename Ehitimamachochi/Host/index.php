<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include database connection
include '../assets/conn.php';

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
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Times New Roman', Times, serif;
        }

        .navbar-nav {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .modal-content {
            width: 100%;
            margin: auto;
        }

        .modal-body {
            padding: 0;
            margin: 0;
            height: calc(100% - 60px);
            overflow-y: auto;
        }

        .section {
            display: none;
            /* Start with sections hidden */
        }

        .modal-header .btn-close {
            position: absolute;
            right: 15px;
            top: 15px;
        }

        .table {
            width: 90%;
            align-items: center;
            margin-left: 5%;
            ;
        }

        .nav-link:hover {
            font-size: 18px;
            border-bottom: 1px solid blue;
        }
    </style>
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
                        <a class="nav-link" href="http://localhost/New/Ehitimamachochi/Host/index.php" 
                            role="button" aria-expanded="false"style="color: white !important;">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#view_food_modal"
                            style="color: white !important; cursor:pointer;">
                            Available Foods
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
                        <a class="nav-link" onclick="toggleSection('Settings_section')" role="button"
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
                                // Database connection
                                $host = 'localhost';
                                $dbname = 'ehms_db';
                                $username = 'root';
                                $password = '24770267';
                                try {
                                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
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

    <script>
        // Toggle between Fast Food and Food tabs
        document.getElementById('fast_food_btn').addEventListener('click', function () {
            document.getElementById('fast_food_modal').style.display = 'block';
            document.getElementById('food_modal').style.display = 'none';
        });
        document.getElementById('food_btn').addEventListener('click', function () {
            document.getElementById('food_modal').style.display = 'block';
            document.getElementById('fast_food_modal').style.display = 'none';
        });
    </script>

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
                                // Database connection
                                $host = 'localhost';
                                $dbname = 'ehms_db';
                                $username = 'root';
                                $password = '24770267';
                                try {
                                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
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

    <script>
        // Toggle between Alcohol Beverage and Soft Beverage tabs
        document.getElementById('alcohol_beverage_btn').addEventListener('click', function () {
            document.getElementById('alcohol_beverage_modal').style.display = 'block';
            document.getElementById('soft_beverage_modal').style.display = 'none';
        });
        document.getElementById('soft_beverage_btn').addEventListener('click', function () {
            document.getElementById('soft_beverage_modal').style.display = 'block';
            document.getElementById('alcohol_beverage_modal').style.display = 'none';
        });
        // Initialize with Soft Beverage as default view
        document.getElementById('soft_beverage_modal').style.display = 'block';
        document.getElementById('alcohol_beverage_modal').style.display = 'none';
        // Show modal
        document.getElementById('open_beverage_modal').addEventListener('click', function () {
            var modal = new bootstrap.Modal(document.getElementById('view_beverage_modal'));
            modal.show();
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ensure SweetAlert2 is loaded before any logic runs
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 is not loaded. Ensure SweetAlert2 script is included.');
            return;
        }

        // Select all elements with the class 'reserve-btn'
        const reserveButtons = document.querySelectorAll('.reserve-btn');

        reserveButtons.forEach(button => {
            button.addEventListener('click', () => handleReservation(button));
        });

        function handleReservation(button) {
            const itemName = button.dataset.item;
            const category = button.dataset.category;
            const price = button.dataset.price;

            // Display SweetAlert2 modal to prompt the user for quantity
            Swal.fire({
                title: `Reserve ${itemName} (${category})`,
                text: 'Enter the quantity to reserve:',
                input: 'number',
                inputLabel: 'Quantity',
                inputPlaceholder: 'Enter quantity',
                inputAttributes: {
                    min: 1,
                    step: 1
                },
                showCancelButton: true,
                confirmButtonText: 'Yes, reserve it!',
                cancelButtonText: 'No, cancel!',
                inputValidator: (value) => {
                    if (!value || value <= 0) {
                        return 'Please enter a valid quantity greater than 0!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Extract the quantity entered by the user
                    const quantity = result.value;

                    // Proceed to reserve the item by sending a request to the server
                    reserveItem(itemName, category, price, quantity);
                }
            });
        }

        function reserveItem(itemName, category, price, quantity) {
            // Prepare reservation details
            const reservationDetails = {
                item_name: itemName,
                quantity: quantity,
                price: price,
                reported_date: new Date().toISOString().split('T')[0] // Format as YYYY-MM-DD
            };

            // Send reservation request to the server via fetch
            fetch('reservation_process.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(reservationDetails)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Reserved!', `${itemName} has been successfully reserved.`, 'success');
                } else {
                    Swal.fire('Error!', 'There was an issue reserving the item. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Reservation error:', error);
                Swal.fire('Error!', 'An unexpected error occurred. Please try again.', 'error');
            });
        }
    });
</script>





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

    <div class="section" id="Settings_section" style="display:none;">
        <div class="container mt-5" style="max-width: 600px;">
            <h2 class="text-center mb-4"><i class="bi bi-gear-fill me-2"></i>Account Settings</h2>
            <div id="set_option" class="list-group">
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                    onclick="showSection('change_username')">
                    <span><i class="bi bi-person-fill me-2"></i>Change Username</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                    onclick="showSection('change_password')">
                    <span><i class="bi bi-lock-fill me-2"></i>Change Password</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                    onclick="confirmLogout(event)">
                    <span><i class="bi bi-box-arrow-right me-2"></i>Log out</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <script>
                    function confirmLogout(event) {
                        event.preventDefault(); // Prevent the default link behavior
                        Swal.fire({
                            icon: 'question',
                            title: 'Are you sure?',
                            text: 'Do you want to log out?',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, log out',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to the specified URL
                                window.location.href = "http://localhost/New/Ehitimamachochi/index/index.php";
                            }
                        });
                    }
                </script>
            </div>

            <!-- Change Username Section -->
            <div class="card mt-4" id="change_username" style="display:none;">
                <div class="card-body">
                    <h3 class="card-title"><i class="bi bi-person-fill me-2"></i>Change Username</h3>
                    <form action="change_username_process.php" method="post">
                        <div class="mb-3">
                            <label for="current_username" class="form-label">Current Username:</label>
                            <input type="text" id="current_username" name="current_username" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password:</label>
                            <input type="password" id="current_password" name="current_password" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="new_username" class="form-label">New Username:</label>
                            <input type="text" id="new_username" name="new_username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_username" class="form-label">Confirm New Username:</label>
                            <input type="text" id="confirm_username" name="confirm_username" class="form-control"
                                required>
                        </div>
                        <div class="d-flex justify-content-center gap-2">
                            <button type="submit" name="change_username" class="btn btn-success"><i
                                    class="bi bi-check-circle me-2"></i>Update</button>
                            <button type="reset" class="btn btn-secondary"><i
                                    class="bi bi-x-circle me-2"></i>Clear</button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="card mt-4" id="change_password" style="display:none;">
                <div class="card-body">
                    <h3 class="card-title"><i class="bi bi-lock-fill me-2"></i>Change Password</h3>
                    <form action="change_password_process.php" method="post">
                        <div class="mb-3">
                            <label for="current_username" class="form-label">Current Username:</label>
                            <input type="text" id="current_username" name="current_username" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password:</label>
                            <input type="password" id="current_password" name="current_password" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password:</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                                required>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit" name="change_password" class="btn btn-success">
                                <i class="bi bi-check-circle me-2"></i>Change
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Clear
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function showSection(id) {
                // Get all sections
                const sections = document.querySelectorAll('.card');

                // Hide all sections
                sections.forEach(section => {
                    if (section.id !== id) {
                        section.style.display = 'none';
                    }
                });

                // Toggle the selected section
                const selectedSection = document.getElementById(id);
                selectedSection.style.display = (selectedSection.style.display === 'none' || selectedSection.style.display === '') ? 'block' : 'none';
            }
        </script>
    </div>

    <script>
        function toggleSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section.style.display === 'none' || section.style.display === '') {
                section.style.display = 'block';
                document.getElementById('main_content').style.display = 'none';
            } else {
                section.style.display = 'none'; main_content
                document.getElementById('main_content').style.display = 'block';
            }
        }
    </script>

    <script>
        // Get the modal and button elements
        var openModal = document.getElementById('Authorize_Customer_btn');
        var authorizeCustomerModal = document.getElementById('Authorize_Customer_modal');

        // Open the modal when the button is clicked
        openModal.onclick = function () {
            authorizeCustomerModal.style.display = 'block';
        }
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>