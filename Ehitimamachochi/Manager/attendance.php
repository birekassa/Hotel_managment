<?php
// Database connection details
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

// Retrieve form data for attendance
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['take_attendance'])) {
    if (isset($_POST['emp_id'], $_POST['is_present'])) {
        $emp_id = $conn->real_escape_string($_POST['emp_id']);
        $is_present = $conn->real_escape_string($_POST['is_present']);
        // Set the current date
        $attendance_date = date('Y-m-d');
        // Convert `is_present` value ('yes' means present, anything else means absent)
        $is_present_value = ($is_present === 'yes') ? 'yes' : 'not';
        try {
            // Start transaction
            $conn->begin_transaction();
            // Check if the attendance record for this employee on this date already exists
            $check_sql = "SELECT * FROM attendance WHERE employee_id = '$emp_id' AND DATE(attendance_date) = '$attendance_date'";
            $result = $conn->query($check_sql);
            if ($result->num_rows > 0) {
                // If the record exists, update it
                $sql = "UPDATE attendance SET is_present = '$is_present_value', attendance_date = NOW() WHERE employee_id = '$emp_id' AND DATE(attendance_date) = '$attendance_date'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Attendance has been updated to present.',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.history.back();
                                        }
                                    });
                                });
                            </script>";
                } else {
                    throw new Exception("Error updating attendance: " . $conn->error);
                }
            } else {
                // If the record doesn't exist, insert a new one
                $sql = "INSERT INTO attendance (employee_id, attendance_date, is_present) VALUES ('$emp_id', NOW(), '$is_present_value')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Attendance recorded successfully.',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.history.back();
                                        }
                                    });
                                });
                            </script>";
                } else {
                    throw new Exception("Error recording attendance: " . $conn->error);
                }
            }

            // Update the employee's status in the `employees` table
            $update_sql = "UPDATE employees SET is_present = '$is_present_value' WHERE id = '$emp_id'";
            if ($conn->query($update_sql) === TRUE) {
                $conn->commit();
            } else {
                throw new Exception("Error updating employee status: " . $conn->error);
            }

        } catch (Exception $e) {
            $conn->rollback();
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: '" . $e->getMessage() . "',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.history.back();
                                }
                            });
                        });
                    </script>";
        }
        // Close connection
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Panel</title>
    <!-- Bootstrap 5.1.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-xl">
            <a class="navbar-brand" href="#">Manager Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-house-door me-2"></i>Home
                        </a>
                    </li>
                    <!-- Manage Inventory -->
                    <li class="nav-item">
                        <a class="nav-link" href="manageInventory.php">
                            <i class="bi bi-boxes me-2"></i>Manage Inventory
                        </a>
                    </li>
                    <!-- Manage Employee -->
                    <li class="nav-item">
                        <a class="nav-link" href="manage_employees.php">
                            <i class="bi bi-person-badge me-2"></i>Manage Employee
                        </a>
                    </li>
                    <!-- Sales Reports -->
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php">
                            <i class="bi bi-bar-chart-line me-2"></i>Reports
                        </a>
                    </li>
                    <!-- Other Operation -->
                    <li class="nav-item">
                        <a class="nav-link" href="otherOperation.php">
                            <i class="bi bi-tools me-2"></i>Other Operation
                        </a>
                    </li>
                    <!-- Settings -->
                    <li class="nav-item">
                        <a class="nav-link" href="Settings.php">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title text-center mb-4">Search Employee</h5>
                        <form class="d-flex">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
                                <input type="search" class="form-control" name="emp_id" id="emp_id" placeholder="Enter Employee ID" aria-label="Search" aria-describedby="basic-addon1">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i> Search
                                </button>
                            </div>
                        </form>
                        <!-- Search Results -->
                        <div id="search-results" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        // JavaScript for real-time search
        document.getElementById('emp_id').addEventListener('input', function() {
            var empId = this.value;

            if (empId.length > 0) {
                fetch('fetch_employee.php?emp_id=' + encodeURIComponent(empId))
                    .then(response => response.json())
                    .then(data => {
                        let output = '';

                        // Create table structure
                        output += `
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Position</th>
                                        <th>Email</th>
                                        <th>is_present</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        if (data.length > 0) {
                            data.forEach(employee => {
                                output += `
                                    <tr>
                                        <td><b>${employee.id}</b></td>
                                        <td>${employee.f_name}</td>
                                        <td>${employee.l_name}</td>
                                        <td>${employee.position}</td>
                                        <td>${employee.email}</td>
                                        <td>
                                            <button class="btn btn-secondary" onclick="submitEmployeeForm('${employee.id}', '${employee.is_present}')">
                                                ${employee.is_present === 'yes' ? 'Present' : 'Absent'}
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            });
                        } else {
                            output += '<tr><td colspan="6">No employees found</td></tr>';
                        }

                        output += `
                                </tbody>
                            </table>
                        `;

                        document.getElementById('search-results').innerHTML = output;
                    })
                    .catch(error => console.error('Error fetching employee data:', error));
            } else {
                document.getElementById('search-results').innerHTML = '';
            }
        });

        // Function to create and submit a form with employee details
        function submitEmployeeForm(id, is_present) {
            if (is_present === 'yes') {
                alert("The employee is already marked as present today.");
                return;
            }

            // Create a form element
            var form = document.createElement('form');
            form.method = 'post';
            // Create hidden inputs for each piece of data
            form.innerHTML = `
                <input type="hidden" name="emp_id" value="${id}">
                <input type="hidden" name="is_present" value="yes">
                <input type="hidden" name="take_attendance" value="1">
            `;
            
            // Append the form to the body and submit it
            document.body.appendChild(form);
            form.submit();
        }

    </script>
</body>
</html>
