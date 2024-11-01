<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="asset/report.css">
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 1.25rem; height: 100px;">
        <div class="container-xl h-100">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">Casher panel</a>
            <div class="collapse navbar-collapse h-100 d-flex align-items-center" id="navbarNav">
                <ul class="navbar-nav d-flex justify-content-center w-100 mb-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php" style="margin: 0 1rem;"><i
                                class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Reports.php" style="margin: 0 1rem;"><i
                                class="fas fa-file-invoice-dollar"></i> Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="payment.php" style="margin: 0 1rem;">Pay Salary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Settings.php" style="margin: 0 1rem;"><i
                                class="fas fa-user-cog"></i> Account Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div id="mainContainer" class="container-fluid" style="width: 80%; margin: 0 auto;">
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
        </div>
    </div>


    <!-- Write Reports Section -->
    <section id="WriteReports" class="hidden">
        <button onclick="goBack()" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back
        </button>

        <form action="write_report.php" method="post">
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <label for="report_provider" class="me-2">Report Provider:</label>
                    <input type="text" class="form-control" name="report_provider" id="report_provider" required>
                </div>

                <div class="d-flex align-items-center">
                    <label for="reported_date" class="me-2">Reported Date:</label>
                    <input type="date" class="form-control" name="reported_date" id="reported_date" readonly required>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 20px;">
                <p style="margin: 0; font-weight: bold;">Report Type:</p>
                <label for="withdrawal" style="margin-right: 10px;">Withdrawal</label>
                <input type="radio" id="withdrawal" name="transactionType" value="Withdrawal" required>

                <label for="deposit" style="margin-right: 10px;">Deposit</label>
                <input type="radio" id="deposit" name="transactionType" value="Deposit" required>
            </div>
            <table id="reportTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Amount</th>
                        <th>Source from</th>
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

    <footer class="footer bg-dark text-white text-center py-4" style="margin-top: auto;">
        <div class="container">
            <p style="margin: 0;">&copy; 2024 Ehototmamachochi Hotel. All rights reserved.</p>
        </div>
    </footer>
</body>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
                <td><input type="number" name="amount[]" class="form-control" step="any" required></td>
                <td><input type="text" name="source_from[]" class="form-control" required></td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
            `;
        tableBody.appendChild(newRow);
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

    function validateForm() {
        const rows = document.querySelectorAll('#reportTable tbody tr');
        let isValid = true;
        let errorMessages = [];

        rows.forEach((row, index) => {
            const amount = row.querySelector('input[name="amount[]"]').value.trim();
            const sourceFrom = row.querySelector('input[name="source_from[]"]').value.trim();

            let missingColumns = [];

            if (!amount) missingColumns.push('Amount');
            if (!sourceFrom) missingColumns.push('Source from');

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
</script>


</html>