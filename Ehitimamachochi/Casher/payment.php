<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: url('bar_background.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            font-family: 'Times New Roman', Times, serif;
        }
        .navbar {
            background-color: #343a40;
            height: 100px;
        }
        .navbar-nav {
            flex-direction: row;
        }
        .nav-link {
            color: white !important;
        }
        .nav-item {
            font-size: 16px;
        }
        .nav-item:hover {
            border-bottom: 1px solid blue;
        }
        .jumbotron {
            background-color: rgba(255, 255, 255, 0.9);
            color: black;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
        .btn-disabled {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>
</head>
<body>

    <div class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem; height: 100px;">
            <div class="container-xl h-100">
                <a class="navbar-brand" href="index.php">Casher Panel</a>
                <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                    <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php" style="margin: 0 1rem;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Reports.php" style="margin: 0 1rem;">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="payment.php" style="margin: 0 1rem;">Pay Salary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Settings.php" style="margin: 0 1rem;">Account Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container my-5">
            <?php
            //include database connection
            include '../assets/conn.php';
            
            $showAlert = false;

            // Query to fetch employee data
            $query = "SELECT * FROM `employees`";
            $result = $conn->query($query);

            // Generate the employee table
            echo '<table class="table table-striped">';
            echo '<thead><tr>';
            echo '<th>First Name</th><th>Last Name</th><th>Sex</th><th>Age</th><th>Email</th><th>Phone No</th><th>Position</th><th>Education Status</th><th>Payment Status</th><th>Actions</th>';
            echo '</tr></thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                $regDate = new DateTime($row['reg_date']);
                $currentDate = new DateTime();
                $interval = $currentDate->diff($regDate);
                $monthsPassed = ($interval->y * 12) + $interval->m;

                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['f_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['l_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['sex']) . '</td>';
                echo '<td>' . htmlspecialchars($row['age']) . '</td>';
                echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                echo '<td>' . htmlspecialchars($row['phone_no']) . '</td>';
                echo '<td>' . htmlspecialchars($row['position']) . '</td>';
                echo '<td>' . htmlspecialchars($row['edu_status']) . '</td>';
                echo '<td>' . ($row['payment_status'] == 0 ? 'Unpaid' : 'Paid') . '</td>';
                echo '<td>';

                if ($row['payment_status'] == 0) {
                    if ($monthsPassed >= 1) {
                        $showAlert = true;
                    }
                    $id = htmlspecialchars($row['id']);
                    $email = htmlspecialchars($row['email']);
                    $salary = htmlspecialchars($row['salary']);
                    $accountNo = htmlspecialchars($row['Account_no']);

                    echo '<form action="payProcess.php" method="POST" style="display:inline-block;">';
                    echo '<input type="hidden" name="id" value="' . $id . '">';
                    echo '<input type="hidden" name="email" value="' . $email . '">';
                    echo '<input type="hidden" name="salary" value="' . $salary . '">';
                    echo '<input type="hidden" name="account_no" value="' . $accountNo . '">';
                    echo '<button type="submit" class="btn btn-primary btn-sm" onclick="return confirm(\'Are you sure you want to process payment?\')">Pay</button>';
                    echo '</form>';
                } else {
                    echo '<a href="#" class="btn btn-secondary btn-sm btn-disabled">Paid</a>';
                }

                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';

            $conn->close();
            ?>

            <!-- Check if alert needs to be shown -->
            <?php if ($showAlert): ?>
                <script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Payment Overdue',
                            text: 'Reminder: Payment has not been processed for more than a month.',
                        });
                    };
                </script>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
