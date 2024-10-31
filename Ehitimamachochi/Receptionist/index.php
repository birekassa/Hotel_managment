<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist Page - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .btn-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10%;
        }

        .btn-container .btn {
            flex: 1 1 calc(50% - 10%);
            margin-bottom: 1rem;
        }

        .d-none {
            display: none;
        }

        .navbar {
            height: 100px;
        }

        .nav-item {
            margin: 10px;
        }

        .nav-item:hover {
            font-size: 17px;
            border-bottom: 1px blue solid;
            background-color: #333;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-xl">
                <a class="navbar-brand mx-auto" href="index.php">Receptionalist Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbar">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" style="color: white !important;">
                                <i class="bi bi-house-door me-2"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="index.php?section=reservation" style="color: white !important;">
                                <i class="bi bi-calendar-check me-2"></i>Make Reservation
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="cust_Detail.php" style="color: white !important;">
                                <i class="bi bi-people me-2"></i>Customer Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="Reports.php" style="color: white !important;">
                                <i class="bi bi-bar-chart-line me-2"></i>Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Settings.php" style="color: white !important;">
                                <i class="bi bi-gear me-2"></i>Account Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <!-- Main Content -->
    <main class="flex-grow-1 d-block" id="default">
        <div class="jumbotron mt-5 py-5 px-5 rounded mx-3 mx-md-5 bg-white shadow">
            <div class="container">
                <h1 class="display-4 text-center fw-bold">EHITIMAMACHOCHI</h1>
                <div class="text-center mt-4">
                    <img src="https://th.bing.com/th/id/R.7cbb52a0c511ffa7edc75b735926ff1b?rik=IEYConOcb3LtvA&riu=http%3a%2f%2fd6vsczyu1rky0.cloudfront.net%2f36226_b%2fwp-content%2fuploads%2f2020%2f01%2freception-img.png&ehk=Mknv19pdp3Nz5UwXmh4Rb64iSLe98X5NMRfZzOjJSJg%3d&risl=&pid=ImgRaw&r=0"
                        alt="Receptionist Panel" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </main>

    <!-- Reservation Section -->
    <section id="reservation" class="my-5">
        <div class="d-flex w-50 mx-auto justify-content-between gap-2">
            <a id="roomReservationBtn" class="btn btn-primary w-100" href="rooms.php">Room Reservation</a>
            <a id="meetingHallsBtn" class="btn btn-secondary w-100" href="halls.php">Meeting Halls</a>
            <div class="dropdown w-100">
                <button class="btn btn-info dropdown-toggle w-100" type="button" id="manageReservationDropdown" data-bs-toggle="dropdown" aria-expanded="false"> Manage Reservation </button>
                <ul class="dropdown-menu w-100" aria-labelledby="manageReservationDropdown">
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ViewReservationModal">View Reservation</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#UpdateReservationModal">Update
                            Reservation</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#CancelReservationModal">Cancel
                            Reservation</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- View Reservation Modal -->
    <div class="modal fade" id="ViewReservationModal" tabindex="-1" aria-labelledby="ViewReservationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ViewReservationLabel">View Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control">
                        <div class="d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-success mt-4" style="width: 45%;">cancel Reservation</button>
                            <button type="reset" class="btn btn-danger mt-4" style="width: 45%;">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Reservation Modal -->
    <div class="modal fade" id="UpdateReservationModal" tabindex="-1" aria-labelledby="UpdateReservationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateReservationLabel">Update Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control">
                        <div class="d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-success mt-4" style="width: 45%;">cancel Reservation</button>
                            <button type="reset" class="btn btn-danger mt-4" style="width: 45%;">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Reservation Modal -->
    <div class="modal fade" id="CancelReservationModal" tabindex="-1" aria-labelledby="CancelReservationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CancelReservationLabel">Cancel Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control">
                        <div class="d-flex justify-content-center gap-2">
                            <button type="submit" class="btn btn-success mt-4" style="width: 45%;">cancel Reservation</button>
                            <button type="reset" class="btn btn-danger mt-4" style="width: 45%;">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p>&copy; 2024 Ehototmamachochi Hotel. All rights reserved. This Website is powered by MTU Department of SE
            Group 1 Members</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to toggle between reservation section and default content
        function toggleReservationSection() {
            const reservationSection = document.getElementById("reservation");
            const defaultContent = document.getElementById('default');

            // Toggle visibility based on current state
            if (reservationSection.classList.contains("d-none")) {
                reservationSection.classList.remove("d-none");
                defaultContent.classList.add("d-none");
            } else {
                reservationSection.classList.add("d-none");
                defaultContent.classList.remove("d-none");
            }
        }

        // Function to show a specific section based on the ID
        function showSection(id) {
            document.querySelectorAll('section, #default').forEach(section => {
                section.classList.add('d-none');
            });
            document.getElementById(id).classList.remove('d-none');
        }

        // Run on page load to handle URL-based section display
        document.addEventListener('DOMContentLoaded', function () {
            const section = new URLSearchParams(window.location.search).get('section');
            if (section === 'reservation') {
                showSection('reservation');
            }
        });
    </script>
</body>

</html>