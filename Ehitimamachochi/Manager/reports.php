<?php
// Include database connection
// include '../assets/conn.php';
// session_start(); // Start the session

// // // Check if the user's position is 'casher'
// // if ($_SESSION['position'] !== 'casher' && $_SESSION['position'] !== 'Casher') {
// //     // Redirect to login page if the user is not a 'casher'
// //     header("Location: ../index/index.php");
// //     exit();
// // }

// // Check if the user is logged in
// // if (!isset($_SESSION['username'])) {
// //     // Redirect to login page if not logged in
// //     header("Location: ../index/index.php");
// //     exit();
// // }

// $position = $_SESSION['position'];
// $report_provider_name = ''; // Initialize variable

// // Prepare and execute statement to fetch first name, last name, and ID number based on the username
// $stmt = $conn->prepare("SELECT f_name, l_name, id FROM employees WHERE username = ?");
// if (!$stmt) {
//     die("Prepare failed: " . $conn->error);
// }

// $stmt->bind_param("s", $username);
// $stmt->execute();
// $stmt->bind_result($f_name, $l_name, $id);
// $stmt->fetch();

// // Check if names and ID were retrieved successfully
// if ($f_name && $l_name && $id) {
//     $report_provider_name = 'ID: '.$id.',   Name : '.$f_name.' '.$l_name; // Combine first name, last name, and ID
// } else {
//     $report_provider_name = 'Unknown Provider'; // Fallback if no name or ID is found
// }

// // Close the statement and connection
// $stmt->close();
// $conn->close();
// ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Internal CSS */
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Times New Roman', Times, serif;
        }

        .content {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }

        .navbar-nav .nav-link::after {
            content: '';
            display: block;
            height: 2px;
            background-color: white;
            width: 0;
            position: absolute;
            left: 0;
            bottom: 0;
            transition: width 0.3s;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        .navbar {
            height: 100px;
            margin-top: 1rem;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .hidden {
            display: none;
        }

        .comment-item {
            background-color: rgb(85, 82, 82);
            border-radius: 10px;
            margin-bottom: 1rem;
            padding: 0.5rem;
            color: white;
        }

        .comment-item p {
            margin: 0;
        }

        .comment-item p:first-child {
            text-align: left;
        }

        .comment-item .date {
            font-size: 0.9rem;
            text-align: right;
        }
    </style>
</head>

<body>
      <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark position-relative" style="background-color: #343a40;">
        <div class="container-xl">
            <a class="navbar-brand" href="#" style="padding-left: 10px;">Manager Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"
                    style="display: flex; justify-content: center; flex-grow: 1;">
                    <!-- Home Dropdown -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-house-door me-2"></i>Home
                        </a>
                    </li>
                    <!-- Manage Inventory -->
                    <li class="nav-item">
                        <a class="nav-link" href="inventory/manageInventory.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-boxes me-2"></i>Manage Inventory
                        </a>
                    </li>
                    <!-- Manage Employee -->
                    <li class="nav-item">
                        <a class="nav-link" href="employee/manage_employees.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-person-badge me-2"></i>Manage Employee
                        </a>
                    </li>
                    <!-- Sales Reports -->
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-bar-chart-line me-2"></i>Reports
                        </a>
                    </li>
                    <!-- Other Operations -->
                    <li class="nav-item">
                        <a class="nav-link" href="otherOperation.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-tools me-2"></i>Other Operations
                        </a>
                    </li>
                    <!-- Settings -->
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php"
                            style="color: white !important; font-size: 1rem; text-decoration: none; padding: 10px; position: relative;">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Container -->
    <div id="mainContainer" class="container-fluid">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="showSection('ViewReports')">
                <span><i class="bi bi-file-earmark-text me-2"></i>View Reports</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="showSection('WriteReports')">
                <span><i class="bi bi-pencil me-2"></i>Write Reports</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                onclick="showSection('commentsSection')">
                <span><i class="bi bi-chat-dots me-2"></i>View Comments</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>

    <!-- View Reports Section -->
    <section id="ViewReports" class="hidden container-fluid">
        <button onclick="goBack()" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back
        </button>
        <div class="list-group">
            <a href="#"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-bar-chart me-2"></i>Inventory Reports</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-archive me-2"></i>Rooms Reports</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-building me-2"></i>Halls Reports</span>
                <i class="bi bi-chevron-right"></i>
            </a>
            <a href="#"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-file-text me-2"></i>Other Reports</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </section>

    <!-- Write Reports Section -->
    <section id="WriteReports" class="hidden container-fluid">
        <button onclick="goBack()" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back
        </button>
        <form action="submit_report.php" method="post">
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <label for="report_provider" class="me-2">Report Provider:</label>
                    <input type="text" class="form-control" name="report_provider" id="report_provider"value="<?php echo htmlspecialchars($report_provider_name); ?>" readonly required>
                </div>
                <div class="d-flex align-items-center">
                    <label for="reported_date" class="me-2">Reported Date:</label>
                    <input type="date" class="form-control" name="reported_date" id="reported_date" required>
                </div>
            </div>
            <table id="reportTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>List</th>
                        <th>Measurement</th>
                        <th>Quantity</th>
                        <th>Single Price</th>
                        <th>Total Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows will be added here -->
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" onclick="addRow()">Add Row</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </section>

    <!-- js  -->
    <script>
        let rowCount = 0;

        function addRow() {
            rowCount++;
            const tableBody = document.querySelector('#reportTable tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td>${rowCount}</td>
            <td><input type="text" name="list[]" class="form-control" required></td>
            <td><input type="text" name="measurement[]" class="form-control" required></td>
            <td><input type="number" name="quantity[]" class="form-control" step="any" required></td>
            <td><input type="number" name="single_price[]" class="form-control" step="any" required></td>
            <td><input type="number" name="total_price[]" class="form-control" step="any" readonly></td>
            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
        `;
            tableBody.appendChild(newRow);

            // Add event listener to update total price when quantity or single price changes
            newRow.querySelector('input[name="quantity[]"]').addEventListener('input', updateTotalPrice);
            newRow.querySelector('input[name="single_price[]"]').addEventListener('input', updateTotalPrice);
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
            updateRowNumbers();
        }

        function updateRowNumbers() {
            const rows = document.querySelectorAll('#reportTable tbody tr');
            rows.forEach((row, index) => {
                row.querySelector('td:first-child').textContent = index + 1;
            });
            rowCount = rows.length;
        }

        function updateTotalPrice(event) {
            const row = event.target.closest('tr');
            const quantity = parseFloat(row.querySelector('input[name="quantity[]"]').value) || 0;
            const singlePrice = parseFloat(row.querySelector('input[name="single_price[]"]').value) || 0;
            const totalPrice = quantity * singlePrice;
            row.querySelector('input[name="total_price[]"]').value = totalPrice.toFixed(2);
        }

        function validateForm() {
            const rows = document.querySelectorAll('#reportTable tbody tr');
            let isValid = true;
            let errorMessages = [];

            rows.forEach((row, index) => {
                const list = row.querySelector('input[name="list[]"]').value.trim();
                const measurement = row.querySelector('input[name="measurement[]"]').value.trim();
                const quantity = row.querySelector('input[name="quantity[]"]').value.trim();
                const singlePrice = row.querySelector('input[name="single_price[]"]').value.trim();
                const totalPrice = row.querySelector('input[name="total_price[]"]').value.trim();

                let missingColumns = [];

                if (!list) missingColumns.push('List');
                if (!measurement) missingColumns.push('Measurement');
                if (!quantity) missingColumns.push('Quantity');
                if (!singlePrice) missingColumns.push('Single Price');
                if (!totalPrice) missingColumns.push('Total Price');

                if (missingColumns.length > 0) {
                    isValid = false;
                    errorMessages.push(`Row ${index + 1}: Missing ${missingColumns.join(', ')}`);
                }
            });

            if (!isValid) {
                alert('Please fill out all required fields:\n' + errorMessages.join('\n'));
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }

        // Attach validateForm function to form's submit event
        document.querySelector('form').addEventListener('submit', function (event) {
            if (!validateForm()) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    </script>

    <!-- Income Reports Section -->
    <section id="incomeReports" class="hidden container-fluid">
        <button onclick="goBack()" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back
        </button>
        <div class="list-group">
            <a href="#"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <span><i class="bi bi-cash-stack me-2"></i>Today's Income Reports</span>
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </section>

    <!-- Comments Section -->
    <section id="commentsSection" class="hidden container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <button onclick="goBack()" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </button>
        </div>
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-danger" onclick="deleteAllComments()">
                <i class="bi bi-trash"></i> Delete all comments
            </button>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function deleteAllComments() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Do you really want to delete all comments?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('delete_all_comments.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                }
                            })
                                .then(response => response.json())
                                .then(result => {
                                    if (result.success) {
                                        loadComments(); // Reload comments after deletion
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Deleted!',
                                            text: 'All comments have been deleted.',
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Error deleting comments: ' + result.error,
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error deleting comments:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while deleting comments.',
                                    });
                                });
                        }
                    });
                }
            </script>
        </div>

        <div id="commentsContainer">
            <!-- Comments will be dynamically inserted here -->
        </div>

        <script>
            // Function to fetch and display comments
            function loadComments() {
                fetch('fetch_comments.php')  // Adjust the URL to your PHP script
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(comments => {
                        const commentsContainer = document.getElementById('commentsContainer');
                        commentsContainer.innerHTML = ''; // Clear any existing content

                        if (comments.length === 0) {
                            commentsContainer.innerHTML = `
                    <div style="width: 400px; margin: 0 auto; text-align: center;">
                        <p>No comments provided yet.</p>
                    </div>
                `;
                        } else {
                            comments.forEach(comment => {
                                const commentDiv = document.createElement('div');
                                commentDiv.classList.add('comment-item');

                                commentDiv.innerHTML = `
                        <p><i class="bi bi-person"></i> <strong>${comment.fromUserName}</strong></p>
                        <hr>
                        <p style="text-align:center;">${comment.theComment}</p>
                        <p class="date">Date: ${comment.Date}</p>
                        <p class="date">
                            <button onclick="deletetheComment('${comment.fromUserName}', '${comment.theComment}', '${comment.Date}')" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </p>
                    `;

                                commentsContainer.appendChild(commentDiv);
                            });
                        }
                    })
                    .catch(error => console.error('Error loading comments:', error));
            }

            // Function to handle comment deletion
            function deletetheComment(fromUserName, theComment, Date) {
                // Show confirmation dialog using SweetAlert2
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you really want to delete this comment?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('delete_comment.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({
                                'from_user_name': fromUserName,
                                'the_comment': theComment,
                                'comment_date': Date
                            }),
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok: ' + response.statusText);
                                }
                                return response.json();
                            })
                            .then(result => {
                                if (result.success) {
                                    loadComments(); // Reload comments after deletion
                                    Swal.fire(
                                        'Deleted!',
                                        result.message,
                                        'success'
                                    ); // Show success message
                                } else {
                                    console.error('Error deleting comment:', result.error);
                                    Swal.fire(
                                        'Error!',
                                        'Error deleting comment: ' + result.error,
                                        'error'
                                    ); // Show error message
                                }
                            })
                            .catch(error => {
                                console.error('Error deleting comment:', error);
                                Swal.fire(
                                    'Error!',
                                    'Error deleting comment: ' + error.message,
                                    'error'
                                ); // Show error message
                            });
                    }
                });
            }
            // Call the function to load comments when the page is loaded
            window.onload = loadComments;
        </script>
    </section>



    <!-- JavaScript -->
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showSection(id) {
            document.getElementById('mainContainer').classList.add('hidden');
            document.querySelectorAll('section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(id).classList.remove('hidden');
        }

        function goBack() {
            document.getElementById('mainContainer').classList.remove('hidden');
            document.querySelectorAll('section').forEach(section => {
                section.classList.add('hidden');
            });
        }

        function addRow() {
            const tableBody = document.querySelector('#reportTable tbody');
            const rowCount = tableBody.rows.length;
            const newRow = tableBody.insertRow();
            newRow.innerHTML = `
                <tr>
                    <td>${rowCount + 1}</td>
                    <td><input type="text" class="form-control" name="list[]"></td>
                    <td><input type="text" class="form-control" name="measurement[]"></td>
                    <td><input type="number" class="form-control" name="quantity[]"></td>
                    <td><input type="number" class="form-control" name="single_price[]"></td>
                    <td><input type="number" class="form-control" name="total_price[]"></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)"><i class="bi bi-trash"></i> Remove</button></td>
                </tr>
            `;
        }

        function removeRow(button) {
            button.closest('tr').remove();
        }
    </script>
</body>

</html>