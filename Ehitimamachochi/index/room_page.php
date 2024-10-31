<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Types</title>
    <!-- Bootstrap 5.1.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="get_room_price.php"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch('fetch_room_counts.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('num_std').textContent = data.standard || '0';
                    document.getElementById('num_del').textContent = data.deluxe || '0';
                    document.getElementById('num_sui').textContent = data.suite || '0';
                    document.getElementById('num_lux').textContent = data.luxury || '0';
                })
                .catch(error => console.error('Error:', error));
        });

        function showModal(roomType) {
            document.getElementById('room_type').value = roomType;
            document.getElementById('room_payment').style.display = 'block';
        }

        function hideModal() {
            document.getElementById('room_payment').style.display = 'none';
        }
    </script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
        }

        .navbar {
            height: 80px;
            /* Consistent height */
            padding: 1rem 2rem;
        }

        .nav-link {
            margin: 0 1rem;
            /* Adjust margin for better spacing */
            color: #ffffff !important;
            /* Ensure text color is white */
        }

        .nav-link:hover {
            border-bottom: 2px solid blue;
            /* Slightly thicker border */
            color: lightblue !important;
            /* Change text color on hover */
        }

        .dropdown-menu {
            background-color: #343a40;
            /* Ensure dropdown menu has the same background color */
        }

        .dropdown-item {
            color: #ffffff !important;
            /* Ensure text color is white */
        }

        .dropdown-item:hover {
            color: lightblue !important;
            /* Change text color on hover */
            background-color: #495057;
            /* Optional: change background color on hover */
        }

        .navbar-nav {
            align-items: center;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-xl d-flex align-items-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: #ffffff; margin-right:30%;">Reserve Room</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewReservationModal">
                            <i class="bi bi-eye me-2"></i> View Your Reservation
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#MyUpdateReservationModal">
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
    <div class="modal fade" id="viewReservationModal" tabindex="-1" aria-labelledby="viewReservationModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewReservationModalLabel">View Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="View_room_reservation.php" method="POST">
                        <div class="mb-3">
                            <label for="View_email" class="form-label">Email:</label>
                            <input type="email" id="View_email" name="View_email" class="form-control"
                                placeholder="example@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="View_password" class="form-label">Password:</label>
                            <input type="password" id="View_password" name="View_password" class="form-control"
                                required>
                        </div>
                        <div style="display: flex; justify-content: center; gap: 5%;">
                            <button style="width: 40%;" type="submit" class="btn btn-primary">View Reservation</button>
                            <button style="width: 40%;" type="reset" class="btn btn-danger">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Reservation Modal -->
    <div class="modal fade" id="MyUpdateReservationModal" tabindex="-1" aria-labelledby="MyUpdateReservationModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="MyUpdateReservationModalLabel">Update Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_room_reservation.php" method="POST">
                        <div class="mb-3">
                            <label for="my_update_email" class="form-label">Enter Email:</label>
                            <input type="email" id="my_update_email" name="my_update_email" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="my_update_password" class="form-label">Enter Password:</label>
                            <input type="password" id="my_update_password" name="my_update_password"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="my_update_room_type" class="form-label">Select New Room Type:</label>
                            <select name="my_update_room_type" id="my_update_room_type" class="form-control" required>
                                <option value="standard" selected>Standard</option>
                                <option value="deluxe">Deluxe</option>
                                <option value="suite">Suite</option>
                                <option value="luxury">Luxury</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="my_update_room_id" class="form-label">Select New Room ID:</label>
                            <select name="my_update_room_id" id="my_update_room_id" class="form-control" required>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="my_update_room_price" class="form-label">Payment:</label>
                            <input type="number" id="my_update_room_price" name="my_update_room_price"
                                class="form-control" readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="my_update_checkin_date">New Check-In Date:</label>
                            <input type="date" class="form-control" id="my_update_checkin_date"
                                onchange="ValidateUpdateTime()" name="my_update_checkin_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="my_update_checkout_date">New Check-Out Date:</label>
                            <input type="date" class="form-control" id="my_update_checkout_date"
                                onchange="ValidateUpdateTime()" name="my_update_checkout_date" required>
                        </div>

                        <script>
                            function ValidateUpdateTime() {
                                let Update_checkin_date = new Date(document.getElementById('my_update_checkin_date').value);
                                let Update_checkout_date = new Date(document.getElementById('my_update_checkout_date').value);

                                if (Update_checkin_date >= Update_checkout_date) {
                                    alert('Please enter a valid check-in and check-out date.');
                                    // Clear the dates if invalid
                                    document.getElementById('my_update_checkin_date').value = '';
                                    document.getElementById('my_update_checkout_date').value = '';
                                }
                            }
                        </script>

                        <div class="d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-success mt-4" style="width: 45%;">Update
                                Reservation</button>
                            <button type="reset" class="btn btn-danger mt-4" style="width: 45%;">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let baseRoomPrice = 0; // Store the base room price separately

            // Fetch and populate room IDs based on the selected room type
            function updatefetchRoomIds(roomType) {
                if (!roomType) return;

                fetch(`my_update_get_room_ids.php?my_update_room_type=${encodeURIComponent(roomType)}`)
                    .then(response => response.json())
                    .then(data => {
                        const roomIdSelect = document.getElementById('my_update_room_id');
                        roomIdSelect.innerHTML = data.length === 0
                            ? '<option value="">No rooms available</option>'
                            : data.map(room => `<option value="${room.r_id}">Room ID: ${room.r_id} (${room.r_type})</option>`).join('');

                        if (data.length > 0) {
                            roomIdSelect.selectedIndex = 0; // Select the first room ID
                            updatefetchRoomPrice(roomIdSelect.value); // Fetch price for the first room ID
                        }
                    })
                    .catch(error => console.error('Error fetching room IDs:', error));
            }

            // Fetch and update room price based on the selected room ID
            function updatefetchRoomPrice(roomId) {
                if (!roomId) return;

                fetch(`my_update_get_room_price.php?my_update_room_id=${encodeURIComponent(roomId)}`)
                    .then(response => response.json())
                    .then(data => {
                        const priceInput = document.getElementById('my_update_room_price');
                        if (data && data[0].r_price) {
                            baseRoomPrice = parseFloat(data[0].r_price); // Store the base price
                            priceInput.value = baseRoomPrice.toFixed(2); // Display the base price
                            calculateTotalPrice(); // Recalculate total price
                        } else {
                            priceInput.value = '';
                            baseRoomPrice = 0; // Reset base price if no data
                        }
                    })
                    .catch(error => console.error('Error fetching room price:', error));
            }

            // Calculate total price based on the date range and room price
            function calculateTotalPrice() {
                const checkinDate = document.getElementById('my_update_checkin_date').value;
                const checkoutDate = document.getElementById('my_update_checkout_date').value;

                if (checkinDate && checkoutDate && !isNaN(baseRoomPrice) && baseRoomPrice > 0) {
                    const checkin = new Date(checkinDate);
                    const checkout = new Date(checkoutDate);
                    const daysDiff = (checkout - checkin) / (1000 * 60 * 60 * 24);

                    if (daysDiff > 0) {
                        const totalPrice = daysDiff * baseRoomPrice;
                        document.getElementById('my_update_room_price').value = totalPrice.toFixed(2);
                    } else {
                        document.getElementById('my_update_room_price').value = ''; // Clear price if invalid dates
                    }
                }
            }

            // Event listeners
            document.getElementById('my_update_room_type').addEventListener('change', (event) => {
                updatefetchRoomIds(event.target.value);
            });

            document.getElementById('my_update_room_id').addEventListener('change', (event) => {
                updatefetchRoomPrice(event.target.value);
            });

            document.getElementById('my_update_checkin_date').addEventListener('change', calculateTotalPrice);
            document.getElementById('my_update_checkout_date').addEventListener('change', calculateTotalPrice);

            // Initialize room IDs based on the default selected room type
            updatefetchRoomIds(document.getElementById('my_update_room_type').value);
        });
    </script>



    <!-- Cancel Reservation Modal -->
    <div class="modal fade" id="deleteReservationModal" tabindex="-1" aria-labelledby="deleteReservationModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteReservationModalLabel">Cancel Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="Cancel_room_reservation.php" method="POST">
                        <div class="mb-3">
                            <label for="Delete_email" class="form-label">Email:</label>
                            <input type="email" id="Delete_email" name="Delete_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="Delete_password" class="form-label">Password:</label>
                            <input type="password" id="Delete_password" name="Delete_password" class="form-control"
                                required>
                        </div>
                        <div style="display: flex; justify-content: center; gap: 5%;">
                            <button type="submit" class="btn btn-success mt-4" style="width: 40%;">Cancel
                                Reservation</button>
                            <button type="reset" class="btn btn-danger mt-4" style="width: 40%;">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="container mt-5 pt-5 flex-fill">
        <h2 class="text-center mb-4" style="font-family: 'Times New Roman', Times, serif; color: black;">Select Your
            Choice For Reservation</h2>
        <div class="row g-3">
            <!-- Standard Room Button -->
            <div class="col-md-6 mb-4">
                <div id="standard_bed_btn" class="text-center p-3"
                    style="background-image: url('images/room/level4/level4.1.jpg'); background-size: cover; background-position: center; color: black; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); cursor: pointer; transition: background-color 0.3s; position: relative; height: 300px;">
                    <!-- Room Details on the Left Side -->
                    <div
                        style="width: 35%; background-color: rgba(255, 255, 255, 0.8); border-radius: 8px; padding: 10px; text-align: left; position: absolute; left: 20px; top: 10px;  height: auto; max-height: 60%; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <p style="font-size: 18px; font-weight: bold; margin: 0;">
                                <a href="#" style="color: black; text-decoration: none;">
                                    <i class="fas fa-bed"></i> Standard Rooms
                                </a>
                            </p>
                            <div style="padding-left: 10px;">
                                <p style="font-size: 14px; margin-bottom: 5px;">
                                    Free Rooms: <span id="num_std">0</span>
                                </p>
                                <p style="font-size: 14px; margin-bottom: 5px;">
                                    Price: <span id="std_price" style="font-weight: bold;">500 ETB</span>
                                </p>
                            </div>
                            <!-- Room Packages -->
                            <div style="padding: 0; margin: 0; margin-top: 10px;">
                                <p style="font-weight: bold; text-decoration: underline; margin-bottom: 5px;">Room
                                    Packages</p>
                                <ul
                                    style="list-style-type: none; padding-left: 0; margin-left: 0; margin-bottom: 0; font-size: 12px; line-height: 1.5;">
                                    <li style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-wifi"></i> Free Wi-Fi
                                    </li>
                                    <li style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-shower"></i> Common shawor
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Reserve Button -->
                    <button class="btn btn-primary"
                        style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); width: 60%;"
                        onclick="showModal('Standard')">
                        <i class="fas fa-calendar-check"></i> Reserve Now
                    </button>
                </div>
            </div>

            <!-- Deluxe Room Button -->
            <div class="col-md-6 mb-4">
                <div id="deluxe_bed_btn" class="text-center p-3"
                    style="background-image: url('images/room/level3/level3.1.jpg'); background-size: cover; background-position: center; color: black; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); cursor: pointer; transition: background-color 0.3s; position: relative; height: 300px;">
                    <!-- Room Details on the Left Side -->
                    <div
                        style="width: 35%; background-color: rgba(255, 255, 255, 0.8); border-radius: 8px; padding: 10px; text-align: left; position: absolute; left: 20px; top: 10px;  height: auto; max-height: 60%; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <p style="font-size: 18px; font-weight: bold; margin: 0;">
                                <a href="#" style="color: black; text-decoration: none;">
                                    <i class="fas fa-bed"></i> Deluxe Rooms
                                </a>
                            </p>
                            <div style="padding-left: 10px;">
                                <p style="font-size: 14px; margin-bottom: 5px;">
                                    Free Rooms: <span id="num_del">0</span>
                                </p>
                                <p style="font-size: 14px; margin-bottom: 5px;">
                                    Price: <span id="del_price" style="font-weight: bold;">600ETB</span>
                                </p>
                            </div>
                            <!-- Room Packages -->
                            <div style="padding: 0; margin: 0; margin-top: 10px;">
                                <p style="font-weight: bold; text-decoration: underline; margin-bottom: 5px;">Room
                                    Packages</p>
                                <ul
                                    style="list-style-type: none; padding-left: 0; margin-left: 0; margin-bottom: 0; font-size: 12px; line-height: 1.5;">
                                    <li style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-wifi"></i> Free Wi-Fi
                                    </li>
                                    <li style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-shower"></i> normal shawor
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Reserve Button -->
                    <button class="btn btn-primary"
                        style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); width: 60%;"
                        onclick="showModal('Deluxe')">
                        <i class="fas fa-calendar-check"></i> Reserve Now
                    </button>
                </div>
            </div>

            <!-- Suite Room Button -->
            <div class="col-md-6 mb-4">
                <div id="suite_bed_btn" class="text-center p-3"
                    style="background-image: url('images/room/level2/level2.0.jpg'); background-size: cover; background-position: center; color: black; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); cursor: pointer; transition: transform 0.3s, background-color 0.3s; position: relative; height: 300px;">
                    <!-- Room Details on the Left Side -->
                    <div
                        style="width: 35%; background-color: rgba(255, 255, 255, 0.8); border-radius: 8px; padding: 10px; text-align: left; position: absolute; left: 20px; top: 10px;  height: auto; max-height: 60%; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <p style="font-size: 18px; font-weight: bold; margin: 0;">
                                <a href="#" style="color: black; text-decoration: none;">
                                    <i class="fas fa-bed"></i> Suite Rooms
                                </a>
                            </p>
                            <div style="padding-left: 10px;">
                                <p style="font-size: 14px; margin-bottom: 5px;">
                                    Free Rooms: <span id="num_sui" style="font-weight: bold;">0</span>
                                </p>
                                <p style="font-size: 14px; margin-bottom: 5px;">
                                    Price:<span id="sui_price" style="font-weight: bold;">800 ETB</span>
                                </p>
                            </div>
                            <!-- Room Packages -->
                            <div style="padding: 0; margin: 0; margin-top: 10px;">
                                <p style="font-weight: bold; text-decoration: underline; margin-bottom: 5px;">Room
                                    Packages</p>
                                <ul
                                    style="list-style-type: none; padding-left: 0; margin-left: 0; margin-bottom: 0; font-size: 12px; line-height: 1.5;">
                                    <li style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-wifi"></i> Free Wi-Fi
                                    </li>
                                    <li style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-shower"></i> Hot & Cold Shower
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Reserve Button -->
                    <button class="btn btn-primary"
                        style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); width: 60%;"
                        onclick="showModal('Suite')">
                        <i class="fas fa-calendar-check"></i> Reserve Now
                    </button>
                </div>
            </div>

            <!-- Luxury Room Button -->
            <div class="col-md-6 mb-4">
                <div id="luxury_bed_btn" class="text-center p-3"
                    style="background-image: url('images/room/leve1/level1.1.jpg'); background-size: cover; background-position: center; color: black; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); cursor: pointer; transition: background-color 0.3s; position: relative; height: 300px;">
                    <!-- Room Details on the Left Side -->
                    <div
                        style="width: 35%; background-color: rgba(255, 255, 255, 0.8); border-radius: 8px; padding: 10px; text-align: left; position: absolute; left: 20px; top: 10px; height: auto; max-height: 60%; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <p style="font-size: 18px; font-weight: bold; margin: 0;">
                                <a href="#" style="color: black; text-decoration: none;">
                                    <i class="fas fa-bed"></i> Luxury Rooms
                                </a>
                            </p>
                            <div style="padding-left: 10px;">
                                <p style="font-size: 14px; margin-bottom: 5px;">
                                    Free Rooms: <span id="num_lux">0</span>
                                </p>
                                <p style="font-size: 14px; margin-bottom: 5px;">
                                    Price: <span id="lux_price" style="font-weight: bold;">1000 ETB</span>
                                </p>
                            </div>
                            <!-- Room Packages -->
                            <div style="padding: 0; margin: 0; margin-top: 10px;">
                                <p style="font-weight: bold; text-decoration: underline; margin-bottom: 5px;">Room
                                    Packages</p>
                                <ul
                                    style="list-style-type: none; padding-left: 0; margin-left: 0; margin-bottom: 0; font-size: 12px; line-height: 1.5;">
                                    <li style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-wifi"></i> Free Wi-Fi
                                    </li>
                                    <li style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-shower"></i> Hot & Cold Shower
                                    </li>
                                    <li style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-tv"></i> TV
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Reserve Button -->
                    <button class="btn btn-primary"
                        style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); width: 60%;"
                        onclick="showModal('Luxury')">
                        <i class="fas fa-calendar-check"></i> Reserve Now
                    </button>
                </div>
            </div>

        </div>
    </div>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Room Payment Modal -->
    <div id="room_payment" class="modal" aria-labelledby="modalTitle"
        style="display: none; position: fixed; z-index: 1; left: 0; top: 0; margin: 20px; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.4);">
        <div class="modal-content"
            style="background-color: #fefefe; margin: 5% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 1000px; border-radius: 8px; position: relative;">
            <div class="modal-header" style="position: relative; padding-bottom: 20px;">
                <span id="closeButton" class="close" onclick="hideModal()"
                    style="position: absolute; top: 10px; right: 10px; color: #ff6f61; font-size: 28px; font-weight: bold; cursor: pointer;"
                    onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#ff6f61';">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </span>

                <h1>Put Your Information Here!</h1>
                <p><small>Required fields are followed by *</small></p>
                <hr>
            </div>
            <div class="modal-body">
                <form action="room_payment.php" method="post">
                    <!-- Your Information -->
                    <fieldset style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                        <legend style="font-weight: bold; font-size: 1.2em;">Your Information</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">First Name *</label>
                                <input type="text" name="first_name" class="form-control" id="first_name"
                                    placeholder="First name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Last Name *</label>
                                <input type="text" name="last_name" class="form-control" id="last_name"
                                    placeholder="Last name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email">Email *</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="you@example.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">Phone *</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="+251..."
                                    required>
                            </div>
                        </div>
                    </fieldset>
                    <!-- Room Information -->
                    <fieldset style="border: 1px solid #ddd; padding: 15px; border-radius: 5px;">
                        <legend style="font-weight: bold; font-size: 1.2em;">Room Information</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="room_type">Room Type *</label>
                                <input type="text" class="form-control" id="room_type" name="room_type" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="num_guests">Number of Guests *</label>
                                <input type="number" class="form-control" id="num_guests" name="num_guests"
                                    onchange="validateNoOfGuests()" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_id">Room Id *</label>
                                <select name="room_id" id="room_id" class="form-control" required>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_price">Rooms Price *</label>
                                <input type="number" class="form-control" id="room_price" name="room_price" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="checkin_date">Check-In Date *</label>
                                <input onchange="validateDates()" type="date" class="form-control" id="checkin_date"
                                    name="checkin_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="checkout_date">Check-Out Date *</label>
                                <input onchange="validateDates()" type="date" class="form-control" id="checkout_date"
                                    name="checkout_date" required>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset
                        style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; margin-bottom: 20px; margin-top: 20px;">
                        <legend style="font-weight: bold; font-size: 1.2em;">
                            <input type="checkbox" id="termsCheckbox" required>
                            I accept the Terms and Policy
                        </legend>
                        <ul style="list-style-type: disc; padding-left: 0; padding-left:10%;">
                            <li>Reservations can be canceled before 02:00 PM local time.</li>
                            <li>Reservations can be canceled within 1 hour of booking.</li>
                            <li>You will receive half of 75% of your payment, either in person or by contacting us
                                through the phone.</li>
                        </ul>
                    </fieldset>

                    <div class="d-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-success mt-4" style="width: 45%;">Reserve
                            Room</button>
                        <button type="reset" class="btn btn-danger mt-4" style="width: 45%;">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let baseRoomPrice = 0; // Store the base room price separately

        function fetchRoomIds(roomType) {
            if (!roomType) return;

            fetch('get_room_ids.php?room_type=' + encodeURIComponent(roomType))
                .then(response => response.json())
                .then(data => {
                    const roomIdSelect = document.getElementById('room_id');
                    roomIdSelect.innerHTML = data.length === 0
                        ? '<option value="">No rooms available</option>'
                        : data.map(room => `<option value="${room.r_id}">Room ID: ${room.r_id} (${room.r_type})</option>`).join('');
                })
                .catch(error => console.error('Error fetching room IDs:', error));
        }

        function fetchRoomPrice(roomId) {
            if (!roomId) return;

            fetch('get_room_price.php?room_id=' + encodeURIComponent(roomId))
                .then(response => response.json())
                .then(data => {
                    const priceInput = document.getElementById('room_price');
                    if (data.length > 0) {
                        baseRoomPrice = parseFloat(data[0].r_price); // Store the base price
                        priceInput.value = baseRoomPrice.toFixed(2); // Display the base price
                        calculateTotalPrice(); // Recalculate total price when room price is fetched
                    } else {
                        priceInput.value = '';
                        baseRoomPrice = 0; // Reset base price if no data
                    }
                })
                .catch(error => console.error('Error fetching room price:', error));
        }

        function calculateTotalPrice() {
            const checkinDate = document.getElementById('checkin_date').value;
            const checkoutDate = document.getElementById('checkout_date').value;

            // Ensure both dates and a valid room price are present
            if (checkinDate && checkoutDate && !isNaN(baseRoomPrice) && baseRoomPrice > 0) {
                const checkin = new Date(checkinDate);
                const checkout = new Date(checkoutDate);

                // Calculate the difference in days
                const daysDiff = (checkout - checkin) / (1000 * 60 * 60 * 24);

                // Ensure the difference is positive
                if (daysDiff > 0) {
                    const totalPrice = daysDiff * baseRoomPrice; // Always multiply by the base price
                    document.getElementById('room_price').value = totalPrice.toFixed(2);
                } else {
                    document.getElementById('room_price').value = ''; // Clear price if invalid dates
                }
            }
        }

        function showModal(roomType) {
            document.getElementById('room_type').value = roomType;
            document.getElementById('room_payment').style.display = 'block';
            fetchRoomIds(roomType); // Fetch room IDs when modal is shown
        }

        function hideModal() {
            document.getElementById('room_payment').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const roomType = document.getElementById('room_type').value;
            if (roomType) {
                fetchRoomIds(roomType);
            }

            document.getElementById('room_id').addEventListener('change', (event) => {
                fetchRoomPrice(event.target.value);
            }); baseRoomPrice

            document.getElementById('checkin_date').addEventListener('change', calculateTotalPrice);
            document.getElementById('checkout_date').addEventListener('change', calculateTotalPrice);
        });

        function validateDates() {
            let checkin_date = new Date(document.getElementById('checkin_date').value);
            let checkout_date = new Date(document.getElementById('checkout_date').value);


            // Ensure both dates are selected before checking
            if (document.getElementById('checkin_date').value && document.getElementById('checkout_date').value) {
                if (checkin_date >= checkout_date) {
                    alert('Please enter a valid check-in and check-out date.');
                    // Clear the dates if invalid
                    document.getElementById('checkin_date').value = '';
                    document.getElementById('checkout_date').value = '';
                }
            }

        }
        function validateNoOfGuests() {
            let no_of_guests = parseInt(document.getElementById('num_guests').value);
            if (no_of_guests > 2.000 || no_of_guests < 1) {
                alert("It is not allowed to have more than 2 guests and lessthan 1.");
                // Optionally, reset the input field
                document.getElementById('num_guests').value = '';
            }
        }

    </script>

    <!-- Footer -->
    <footer class="mt-5 bg-dark text-light text-center py-3 " style="width: 100%; color: white;">
        <p>&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
    </footer>

    <!-- Bootstrap 5.1.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>