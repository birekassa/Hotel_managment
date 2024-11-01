<?php
//include database connection
include '../assets/conn.php';

// Handle form submission for reservation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hall_type'])) {
    $selectedType = $_POST['hall_type'];

    // Prepare SQL query to get available hall IDs based on type
    $sql = "SELECT id FROM table_meeting_halls WHERE type = ? AND status = 'free'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedType);
    $stmt->execute();
    $result = $stmt->get_result();

    $hallIds = [];
    while ($row = $result->fetch_assoc()) {
        $hallIds[] = $row;
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($hallIds);
    exit();
}

// SQL query to select all meeting halls where status is 'free' along with their prices
$sql = "SELECT type, price, COUNT(*) AS quantity
        FROM table_meeting_halls
        WHERE status = 'free'
        GROUP BY type, price";

// Execute the query
$result = $conn->query($sql);

$hallData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $type = htmlspecialchars($row['type']);
        $price = htmlspecialchars($row['price']);
        $quantity = $row['quantity'];

        if (!isset($hallData[$type])) {
            $hallData[$type] = ['quantity' => 0, 'price' => $price];
        }
        $hallData[$type]['quantity'] += $quantity;
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Meeting Halls</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<style>
    body {
        font-family: 'Times New Roman', Times, serif;
        margin: 0;
    }

    .navbar {
        height: 100px;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .nav-link,
    .dropdown-item {
        color: #ffffff !important;
        /* Ensure text color is white */
        transition: color 0.3s;
    }

    .nav-link:hover,
    .dropdown-item:hover {
        border-bottom: 2px solid blue;
        /* Slightly thicker border */
        color: lightblue !important;
        /* Change text color on hover */
    }

    .navbar-nav {
        flex: 1;
        /* Make the navbar items take up available space */
        justify-content: center;
        /* Center the items horizontally */
    }

    .dropdown-item {
        color: #ffffff !important;
        padding-left: 10px;
        padding-right: 10px;
    }

    .dropdown-item:hover {
        color: lightblue !important;
        /* Change text color on hover */
        background-color: #495057;
        /* Optional: change background color on hover */
    }
</style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-xl d-flex align-items-center">
            <!-- Toggler Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand" href="#" style="color: #ffffff;">Reserve Meeting Hall</a>
            <!-- Collapsible Navbar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#viewReservationModal">
                            <i class="bi bi-eye me-2"></i> View Your Reservation
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#updateMeetingHallModal">
                            <i class="bi bi-pencil me-2"></i> Update Your Reservation
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#deleteReservationModal">
                            <i class="bi bi-trash me-2"></i> Cancel Your Reservation
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- View Reservation Modal -->
    <div class="modal fade" id="viewReservationModal" tabindex="-1" aria-labelledby="viewReservationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewReservationModalLabel">View Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="view_meetingHalls_reservation.php" method="POST">
                        <div class="mb-3">
                            <label for="View_email" class="form-label">Email:</label>
                            <input type="email" id="View_email" name="View_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="View_password" class="form-label">Password:</label>
                            <input type="password" id="View_password" name="View_password" class="form-control"
                                required>
                        </div>

                        <div style="display:flex; justify-content:center; gap:5%;">
                            <button type="submit" class="btn btn-primary">View Reservation</button>
                            <button type="reset" class="btn btn-danger" style="width:40%;">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Meeting Hall Modal -->
    <div class="modal fade" id="updateMeetingHallModal" tabindex="-1" aria-labelledby="updateMeetingHallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMeetingHallModalLabel">Update Meeting Hall</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_meetingHalls_reservation.php" method="POST">
                        <div class="mb-3">
                            <label for="Update_email" class="form-label">Your Email:</label>
                            <input type="email" id="Update_email" name="Update_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="Update_password" class="form-label">Your Password:</label>
                            <input type="password" id="Update_password" name="Update_password" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="Update_hall_type" class="form-label">New Meeting Hall Type:</label>
                            <select name="Update_hall_type" id="Update_hall_type" class="form-select" required>
                                <option value="">Select Hall Type</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Update_hall_id" class="form-label">New Meeting Hall ID:</label>
                            <select name="Update_hall_id" id="Update_hall_id" class="form-select" required>
                                <option value="">Select Hall ID</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Update_hall_price" class="form-label">New Meeting Hall Price (ETB):</label>
                            <input type="text" id="Update_hall_price" name="Update_hall_price" class="form-control"
                                readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="Update_checkin_date" class="form-label">New Check-in Date:</label>
                            <input type="date" id="Update_checkin_date" name="Update_checkin_date" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="Update_checkout_date" class="form-label">New Check-out Date:</label>
                            <input type="date" id="Update_checkout_date" name="Update_checkout_date"
                                class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-primary w-50">Update Reservation</button>
                            <button type="reset" class="btn btn-danger w-50">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let baseHallPrice = 0; // Initialize the base hall price variable

            // Function to fetch hall types and populate the dropdown
            function fetchHallTypes() {
                fetch('my_update_get_hall_types.php')
                    .then(response => response.json())
                    .then(data => {
                        const hallTypeSelect = document.getElementById('Update_hall_type');
                        hallTypeSelect.innerHTML = '<option value="">Select Hall Type</option>';
                        if (data.length === 0) {
                            hallTypeSelect.innerHTML += '<option value="">No hall types available</option>';
                        } else {
                            data.forEach(type => {
                                const option = document.createElement('option');
                                option.value = type.type;
                                option.textContent = type.type;
                                hallTypeSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching hall types:', error));
            }

            // Function to fetch hall IDs based on the selected hall type
            function fetchHallIds(hallType) {
                if (!hallType) return;

                fetch('my_update_get_hall_ids.php?Update_hall_type=' + encodeURIComponent(hallType))
                    .then(response => response.json())
                    .then(data => {
                        const hallIdSelect = document.getElementById('Update_hall_id');
                        hallIdSelect.innerHTML = '<option value="">Select Hall ID</option>';
                        if (data.length === 0) {
                            hallIdSelect.innerHTML += '<option value="">No halls available</option>';
                        } else {
                            data.forEach(hall => {
                                const option = document.createElement('option');
                                option.value = hall.id;
                                option.textContent = `Hall ID: ${hall.id} (Capacity: ${hall.capacity})`;
                                hallIdSelect.appendChild(option);
                            });
                            hallIdSelect.selectedIndex = 0;
                            fetchHallPrice(hallIdSelect.value); // Fetch the price for the first hall ID
                        }
                    })
                    .catch(error => console.error('Error fetching hall IDs:', error));
            }

            // Function to fetch hall price based on the selected hall ID
            function fetchHallPrice(hallId) {
                if (!hallId) return;

                fetch('my_update_get_hall_price.php?Update_hall_id=' + encodeURIComponent(hallId))
                    .then(response => response.json())
                    .then(data => {
                        const priceInput = document.getElementById('Update_hall_price');
                        if (data && data[0] && data[0].price) {
                            baseHallPrice = parseFloat(data[0].price); // Store base price for calculation
                            priceInput.value = baseHallPrice.toFixed(2); // Set initial price value
                        } else {
                            priceInput.value = '';
                        }
                    })
                    .catch(error => console.error('Error fetching hall price:', error));
            }

            // Function to calculate total price based on check-in and check-out dates
            function calculateTotalPrice() {
                const checkinDate = document.getElementById('Update_checkin_date').value;
                const checkoutDate = document.getElementById('Update_checkout_date').value;

                const priceInput = document.getElementById('Update_hall_price');

                if (checkinDate && checkoutDate && !isNaN(baseHallPrice) && baseHallPrice > 0) {
                    const checkin = new Date(checkinDate);
                    const checkout = new Date(checkoutDate);
                    const daysDiff = (checkout - checkin) / (1000 * 60 * 60 * 24);

                    if (daysDiff > 0) {
                        const totalPrice = daysDiff * baseHallPrice;
                        priceInput.value = totalPrice.toFixed(2);
                    } else if (daysDiff === 0) {
                        priceInput.value = baseHallPrice.toFixed(2); // Show default price if dates are the same
                    } else {
                        priceInput.value = baseHallPrice.toFixed(2); // Show default price if dates are the same
                        alert('Please enter a valid check-in and check-out date.');
                        document.getElementById('Update_checkin_date').value = '';
                        document.getElementById('Update_checkout_date').value = '';
                    }
                } else {
                    priceInput.value = '';
                }
            }

            // Event listeners
            document.getElementById('Update_hall_type').addEventListener('change', function (event) {
                fetchHallIds(event.target.value);
            });

            document.getElementById('Update_hall_id').addEventListener('change', function (event) {
                fetchHallPrice(event.target.value);
            });

            document.getElementById('Update_checkin_date').addEventListener('change', calculateTotalPrice);
            document.getElementById('Update_checkout_date').addEventListener('change', calculateTotalPrice);

            // Initialize with the default selected hall type if available
            document.getElementById('updateMeetingHallModal').addEventListener('shown.bs.modal', function () {
                fetchHallTypes();
            });
        });
    </script>



    <!-- Cancel Reservation Modal -->
    <div class="modal fade" id="deleteReservationModal" tabindex="-1" aria-labelledby="deleteReservationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteReservationModalLabel">Cancel Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="cancel_meetingHalls_reservation.php" method="POST">
                        <div class="mb-3">
                            <label for="Cancel_email" class="form-label">Email:</label>
                            <input type="email" id="Cancel_email" name="Cancel_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="Cancel_password" class="form-label">Password:</label>
                            <input type="password" id="Cancel_password" name="Cancel_password" class="form-control"
                                required>
                        </div>

                        <div style="display:flex; justify-content:center; gap:5%;">
                            <button type="submit" class="btn btn-primary">Cancel Reservation</button>
                            <button type="reset" class="btn btn-danger" style="width:40%;">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container mt-5 pt-5">
        <h1 class="text-center mb-4">Select Meeting Halls</h1>
        <div class="d-flex flex-wrap justify-content-center">
            <?php foreach ($hallData as $type => $data): ?>
                <div class="card m-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($type); ?></h5>

                        <p class="card-text">Price: <?php echo htmlspecialchars($data['price']); ?> ETB</p>
                        <p class="card-text">Available: <?php echo htmlspecialchars($data['quantity']); ?> halls</p>
                        <button class="btn btn-primary"
                            onclick="openReservationModal('<?php echo htmlspecialchars($type); ?>', '<?php echo htmlspecialchars($data['price']); ?>')">Reserve
                            Now</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>



        <!-- Reservation Modal -->
        <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservationModalLabel">Reserve Meeting Hall</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="payments_for_metting_halls_process.php" id="reservationForm" method="POST">
                            <div class="row">
                                <!-- First Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name:</label>
                                        <input type="text" id="first_name" name="first_name" class="form-control"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name:</label>
                                        <input type="text" id="last_name" name="last_name" class="form-control"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sex" class="form-label">Sex:</label><br>
                                        <select name="sex" id="sex" style="padding:8px" required>
                                            <option value="" selected>Select your sex</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone:</label>
                                        <input type="tel" id="phone" name="phone" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Second Column -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="hall_type" class="form-label">Hall Type:</label>
                                        <input type="text" id="hall_type" name="hall_type" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hall_price" class="form-label">Hall Price ETB:</label>
                                        <input type="text" id="hall_price" name="hall_price" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hall_id" class="form-label">Hall ID:</label>
                                        <select id="hall_id" name="hall_id" class="form-select" required>
                                            <option value="">Select Hall ID</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="checkin_date" class="form-label">Check-in Date:</label>
                                        <input type="date" id="checkin_date" name="checkin_date" class="form-control"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="checkout_date" class="form-label">Check-out Date:</label>
                                        <input type="date" id="checkout_date" name="checkout_date" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <fieldset
                        style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; margin-bottom: 20px; margin-top: 20px;">
                        <legend style="font-weight: bold; font-size: 1.2em;">
                            <input type="checkbox" id="termsCheckbox" required>
                            I accept the Terms and Policy
                        </legend>
                        <ul style="list-style-type: disc; padding-left: 0; padding-left:10%;">
                            <li>Reservations can be canceled within 1 hour of booking.</li>
                            <li>You will receive half of 75% of your payment, either in person or by contacting us
                                through the phone.</li>
                        </ul>
                    </fieldset>
                            <div style="display:flex; justify-content:center; gap:5%;">
                                <button type="submit" class="btn btn-primary" style="width:40%;">Reserve Now</button>
                                <button type="reset" class="btn btn-danger" style="width:40%;">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var baseHallPrice = 0; // Initialize the base hall price variable

            function openReservationModal(type, price) {
                document.getElementById('hall_type').value = type;
                baseHallPrice = price; // Set the base hall price
                document.getElementById('hall_price').value = baseHallPrice;

                // Populate hall IDs dynamically based on the selected type
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'get_hall_ids.php', true); // Update with your actual URL
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (this.status === 200) {
                        try {
                            var hallIds = JSON.parse(this.responseText);
                            var hallIdSelect = document.getElementById('hall_id');
                            hallIdSelect.innerHTML = '<option value="">Select Hall ID</option>';
                            hallIds.forEach(function (hall) {
                                var option = document.createElement('option');
                                option.value = hall.id;
                                option.textContent = hall.id;
                                hallIdSelect.appendChild(option);
                            });
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                        }
                    } else {
                        console.error('Request failed with status:', this.status);
                    }
                };

                xhr.send('hall_type=' + encodeURIComponent(type));

                var reservationModal = new bootstrap.Modal(document.getElementById('reservationModal'));
                reservationModal.show();
            }

            function calculateTotalPrice() {
                const checkinDate = document.getElementById('checkin_date').value;
                const checkoutDate = document.getElementById('checkout_date').value;

                if (checkinDate && checkoutDate && !isNaN(baseHallPrice) && baseHallPrice > 0) {
                    const checkin = new Date(checkinDate);
                    const checkout = new Date(checkoutDate);
                    const daysDiff = (checkout - checkin) / (1000 * 60 * 60 * 24);

                    if (daysDiff > 0) {
                        const totalPrice = daysDiff * baseHallPrice;
                        document.getElementById('hall_price').value = totalPrice.toFixed(2);
                    } else {
                        document.getElementById('hall_price').value = ''; // Clear price if invalid dates
                    }
                } else {
                    document.getElementById('hall_price').value = ''; // Clear price if dates are not valid
                }
            }

            // Add event listeners to recalculate price when dates change
            document.getElementById('checkin_date').addEventListener('change', calculateTotalPrice);
            document.getElementById('checkout_date').addEventListener('change', calculateTotalPrice);
        </script>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
        
</body>

</html>