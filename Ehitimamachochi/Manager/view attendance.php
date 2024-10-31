<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container {
            margin-top: 20px;
        }

        .table-wrapper {
            position: relative;
        }

        .filter-buttons {
            margin-bottom: 20px;
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', serif;">
     <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark position-relative" style="background-color: #343a40;">
        <div class="container-xl">
            <a class="navbar-brand" href="#" style="padding-left: 10px;">Manager Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="display: flex; justify-content: center; flex-grow: 1;">
                    <!-- Home Dropdown -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-house-door me-2"></i>Home
                        </a>
                    </li>
                    <!-- Manage Inventory -->
                    <li class="nav-item">
                        <a class="nav-link" href="inventory\manageInventory.php" style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-boxes me-2"></i>Manage Inventory
                        </a>
                    </li>
                    <!-- Manage Employee -->
                    <li class="nav-item">
                        <a class="nav-link" href="employee\manage_employees.php" style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-person-badge me-2"></i> Manage Employee
                        </a>
                    </li>
                    <!-- Sales Reports -->
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php" style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-bar-chart-line me-2"></i> Reports
                        </a>
                    </li>
                    <!-- Other Operation -->
                    <li class="nav-item">
                        <a class="nav-link" href="otherOperation.php" style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-tools me-2"></i> Other Operation
                        </a>
                    </li>
                    <!-- Settings -->
                    <li class="nav-item">
                        <a class="nav-link" href="Settings.php" style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center">Employee Attendance</h1>
        <div class="filter-buttons d-flex justify-content-between mb-3 gap-3">
            <input type="date" id="search_date" class="form-control" style="font-size: 18px; font-weight: bold;">
            <div class="d-flex gap-2">
                <button class="btn btn-primary" onclick="filterAttendance('present')">Show Present</button>
                <button class="btn btn-danger" onclick="filterAttendance('absent')">Show Absent</button>
            </div>
        </div>

        <div class="table-wrapper">
            <?php
            // Database connection
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

            // SQL query to get all employees and their attendance status
            $sql = "
                SELECT e.id, e.f_name, e.l_name, e.sex, e.age, e.email, e.phone_no, e.is_present,
                    a.attendance_date
                FROM employees e LEFT JOIN attendance a ON e.id = a.employee_id
            ";

            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data in a table
                echo '<table class="table table-striped" id="attendance_table">';
                echo '<thead><tr>';
                echo '<th>ID</th>';
                echo '<th>First Name</th>';
                echo '<th>Last Name</th>';
                echo '<th>Sex</th>';
                echo '<th>Age</th>';
                echo '<th>Email</th>';
                echo '<th>Phone No</th>';
                echo '<th>Is Present</th>';
                echo '<th>Attendance Date</th>';
                echo '</tr></thead>';
                echo '<tbody>';

                // Fetch each row and display in table
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['f_name'] . '</td>';
                    echo '<td>' . $row['l_name'] . '</td>';
                    echo '<td>' . $row['sex'] . '</td>';
                    echo '<td>' . $row['age'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['phone_no'] . '</td>';
                    echo '<td>' . $row['is_present'] . '</td>';
                    echo '<td>' . ($row['attendance_date'] ? $row['attendance_date'] : 'N/A') . '</td>';
                    echo '</tr>';
                }

                echo '</tbody></table>';
            } else {
                echo '<p class="text-center">No attendance records found.</p>';
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function filterAttendance(status) {
            const table = document.getElementById('attendance_table');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let row of rows) {
                const isPresentCell = row.cells[7]; // Adjust index based on your table structure
                const isPresent = isPresentCell.textContent.trim().toLowerCase();

                if (status === 'present' && isPresent === 'yes') {
                    row.style.display = '';
                } else if (status === 'absent' && isPresent !== 'yes') {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        document.getElementById('search_date').addEventListener('change', function () {
            const date = this.value;
            const table = document.getElementById('attendance_table');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let row of rows) {
                const dateCell = row.cells[8]; // Adjust index based on your table structure
                const attendanceDate = dateCell.textContent.trim();

                if (date === '' || attendanceDate === date) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    </script>
</body>

</html>
