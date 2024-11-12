<?php
// Include database connection
include '../assets/conn.php';

// Initialize arrays
$Reports = [];
$hall_report = [];

// Fetch inventory data for rooms
$sql = "SELECT * FROM `rooms_reports` WHERE 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Reports[] = $row;
    }
}

// Fetch inventory data for halls
$hall_sql = "SELECT * FROM `halls_reports` WHERE 1";
$result = $conn->query($hall_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hall_report[] = $row;
    }
}

// Close the connection
$conn->close();
?>




<?php
// Include database connection
include '../assets/conn.php';
session_start(); // Start the session

// Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//     // Redirect to login page if not logged in
//     header("Location: index/index.php");
//     exit();
// }

// // Access the session variables
// $username = $_SESSION['username'];
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="asset/report.css" class="css">
</head>

<body>
    <!-- Navbar -->
    <?php include 'asset/navbar.php'; ?>

    <!-- Main Container -->
    <div id="mainContainer" class="container-custom">
        <div class="container">
            <div class="list-group">
                <!-- View Reports -->
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                    onclick="showSection('ViewReports')">
                    <span><i class="bi bi-file-earmark-text me-2"></i>View Reports</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <!-- Write Reports -->
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                    onclick="showSection('WriteReports')">
                    <span><i class="bi bi-pencil me-2"></i>Write Reports</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- View Reports Section -->
    <section id="ViewReports" class="container-custom hidden">
        <div class="container">
            <button onclick="goBack('mainContainer')" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Back
            </button>
            <div class="list-group">
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                    onclick="showSection('view_room_report')">
                    <span><i class="bi bi-archive me-2"></i>Received Items reports </span>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                    onclick="showSection('view_hall_report')">
                    <span><i class="bi bi-building me-2"></i>Sold Items reports</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>
    </section>


    <!--View Rooms Report Section -->
    <section id="view_room_report" class=" container-custom  hidden">
        <div class="container">
            <button onclick="goBack('ViewReports')" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Back
            </button>
            <!-- Search Bar Section -->
            <div class="d-flex justify-content-between mb-4">
                <div class="d-flex">
                    <input type="text" class="form-control me-2" placeholder="Search" />
                    <button class="btn btn-primary">
                        <i class="bi bi-search me-2"></i>Search
                    </button>
                </div>
                <div class="d-flex">
                    <button class="btn btn-outline-secondary me-2">
                        <i class="bi bi-chevron-left me-2"></i>Previous
                    </button>
                    <button class="btn btn-outline-secondary">
                        Next<i class="bi bi-chevron-right me-2"></i>
                    </button>
                </div>
            </div>

            <!-- Report Table Section -->
            <div class="table-responsive">
                <table class="table" style="width:100%; margin-bottom:30px;">
                    <thead>
                        <tr>
                            <th>Beverage Name</th>
                            <th>Beverage Type</th>
                            <th>Measurement</th>
                            <th>Quantity</th>
                            <th>Date Added</th>
                            <th>Added By</th>
                        </tr>
                    </thead>
                    <tbody id="beverageTableBody"></tbody>
                </table>
            </div>

            <!-- More Details Button & Collapse Section -->
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-info" data-bs-toggle="collapse" data-bs-target="#demo">
                    <i class="bi bi-info-circle me-2"></i> More Details
                </button>
            </div>

            <div id="demo" class="collapse mt-3">
                <p>This is the detailed information of the reserved room.</p>
            </div>
        </div>
    </section>



    <!-- Halls Report Section -->
    <section id="view_hall_report" class="container-custom hidden">
        <div class="container">
            <button onclick="goBack('ViewReports')" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Back
            </button>
            <!-- Search Bar Section -->
            <div class="d-flex justify-content-between mb-4">
                <div class="d-flex">
                    <input type="text" class="form-control me-2" placeholder="Search" />
                    <button class="btn btn-primary">
                        <i class="bi bi-search me-2"></i>Search
                    </button>
                </div>
                <div class="d-flex">
                    <button class="btn btn-outline-secondary me-2">
                        <i class="bi bi-chevron-left me-2"></i>Previous
                    </button>
                    <button class="btn btn-outline-secondary">
                        Next <i class="bi bi-chevron-right me-2"></i>
                    </button>
                </div>
            </div>

            <!-- Hall Report Table Section -->
            <div class="table-responsive">
                <table class="table" style="width:100%; margin-bottom:30px;">
                    <thead>
                        <tr>
                            <th>Beverage Name</th>
                            <th>Beverage Type</th>
                            <th>Quantity Sold</th>
                            <th>Date Sold</th>
                            <th>Other Info</th>
                        </tr>
                    </thead>
                    <tbody id="soldBeverageTableBody"></tbody>
                </table>
            </div>
            <!-- Button to Toggle More Details -->
            <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#hallDetails">
                <i class="bi bi-info-circle me-2"></i>More Details
            </button>

            <!-- Collapsible Details Section -->
            <div id="hallDetails" class="collapse mt-3">
                <p>This is halls details.</p>
            </div>
        </div>
    </section>

    <script>
        // Function to show a specific section and hide all others
        function showSection(sectionId) {
            // Hide all sections
            const allSections = document.querySelectorAll('.container-custom, .report-section');
            allSections.forEach(section => section.classList.add('hidden'));

            // Show the selected section
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.classList.remove('hidden');
            }
        }

        // Function to go back to the previous section
        function goBack(previousSectionId) {
            showSection(previousSectionId);
        }
    </script>

    <!-- CSS to hide the sections by default -->
    <style>
        .hidden {
            display: none;
        }

        .container-custom,
        .report-section {
            margin-top: 20px;
        }
    </style>




    <!-- Write Reports Section -->
    <section id="WriteReports" class="container-custom hidden">
        <div class="container">
            <button onclick="goBack('mainContainer')" class="btn btn-secondary mb-3">
                <i class="bi bi-arrow-left"></i> Back
            </button>
            <form action="submit_report.php" method="post">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <label for="report_provider" class="me-2">Report Provider:</label>
                        <input type="text" class="form-control" name="report_provider" id="report_provider"
                            value="<?php echo htmlspecialchars($report_provider_name); ?>" readonly required>
                    </div>
                    <div class="d-flex align-items-center">
                        <select name="report_about" id="report_about" style="padding:10px;" required>
                            <option value="">Select Report About</option>
                            <option value="">Room Report</option>
                            <option value="">Halls Report</option>
                            <option value="">Other</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center">
                        <select name="report_type" id="report_type" style="padding:10px;" required>
                            <option value="">Select Report Type</option>
                            <option value="">Expense</option>
                            <option value="">Income</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="reported_date" class="me-2">Reported Date:</label>
                        <input type="date" class="form-control" name="reported_date" id="reported_date" readonly
                            required>
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
        </div>
    </section>

    <?php include '../assets/footer.php'; ?>


    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('reported_date').value = today;
        });

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

        function showSection(id) {
            document.querySelectorAll('section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(id).classList.remove('hidden');
            document.getElementById('mainContainer').classList.add('hidden');
        }

        function goBack() {
            document.querySelectorAll('section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById('mainContainer').classList.remove('hidden');
        }
    </script>

    <script>

        // Get the current date
        let currentDate = new Date();
        const nextDayButton = document.getElementById('nextDayButton');

        // Function to search for beverages
        function searchBeverage() {
            let searchValue = document.getElementById('searchInput').value;

            fetch('fetch_beverages.php')
                .then(response => response.json())
                .then(data => {
                    let filteredData = data.filter(item =>
                        item.beverage_name.toLowerCase().includes(searchValue.toLowerCase()) ||
                        item.added_at.includes(searchValue)
                    );
                    populateTable(filteredData);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Function to format date as YYYY-MM-DD
        function formatDate(date) {
            let year = date.getFullYear();
            let month = (date.getMonth() + 1).toString().padStart(2, '0');
            let day = date.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Function to load data for the previous day
        function loadPreviousDay() {
            currentDate.setDate(currentDate.getDate() - 1);
            fetchDataForDate(currentDate);
            nextDayButton.disabled = false; // Enable "Next Day" button
        }

        // Function to load data for the next day
        function loadNextDay() {
            currentDate.setDate(currentDate.getDate() + 1);

            let today = new Date();
            if (formatDate(currentDate) >= formatDate(today)) {
                currentDate = today;
                nextDayButton.disabled = true; // Disable "Next Day" button if today is reached
            }

            fetchDataForDate(currentDate);
        }

        // Function to fetch and display data for a specific date
        function fetchDataForDate(date) {
            let formattedDate = formatDate(date);
            console.log("Fetching data for:", formattedDate);

            fetch('fetch_beverages.php')
                .then(response => response.json())
                .then(data => {
                    let filteredData = data.filter(item => item.added_at.includes(formattedDate));
                    if (filteredData.length === 0 && date < new Date()) {
                        // If no data, go to the previous day
                        loadPreviousDay();
                    } else {
                        populateTable(filteredData);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Function to populate the table with data
        function populateTable(data) {
            const tableBody = document.getElementById('beverageTableBody');
            tableBody.innerHTML = ''; // Clear existing rows

            data.forEach(item => {
                let row = `<tr>
                <td>${item.beverage_name}</td>
                <td>${item.beverage_type}</td>
                <td>${item.measurement}</td>
                <td>${item.beverage_quantity}</td>
                <td>${item.added_at}</td>
                <td>${item.added_by}</td>
            </tr>`;
                tableBody.innerHTML += row;
            });
        }

        // Initialize by loading today's data or the most recent available data
        fetchDataForDate(currentDate);
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>