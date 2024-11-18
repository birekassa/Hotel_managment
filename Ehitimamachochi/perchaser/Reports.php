<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchaser Page - Ehototmamachochi Hotel</title>
    <?php include 'asset/bootstrap_links.php'; ?>
    <style>
        .nav-item {
            font-size: 16px;
        }

        .nav-item:hover {
            border-bottom: 1px solid blue;
        }

        .report-section {
            margin-top: 20px;
        }

        .form-control {
            max-width: 300px;
        }

        .btn-primary {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">
    <div class="d-flex flex-column min-vh-100">
        <!-- Navbar -->
        <?php include 'asset/nav-bar.php'; ?>

        <!-- Main Container -->
        <div id="mainContainer" class="container mt-4">
            <div class="report-section container mt-5">
                <!-- Title Section -->
                <div class="text-center mb-4">
                    <h2 class="display-4 text-primary">Instocked Beverages Reports</h2>
                    <h5 class="text-muted">Search Reports by Reported Date</h5>
                </div>

                <!-- Search Form Section -->
                <div class="d-flex justify-content-center mb-4">
                    <form id="searchForm" method="GET" class="d-flex align-items-center">
                        <!-- Date Input Field -->
                        <input type="date" id="searchDate" name="date" class="form-control me-3" required>

                        <!-- Search Button -->
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            <span>Search</span>
                        </button>
                    </form>
                </div>

                <!-- Reports Container -->
                <div id="reportsContainer" class="mt-4">
                    <!-- Dynamic content will be loaded here -->
                    <p class="text-center text-muted">No reports found. Please search by a specific date.</p>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include 'asset/footer.php'; ?>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Placeholder for Dynamic Content -->
        <script>
            const searchForm = document.getElementById('searchForm');
            const reportsContainer = document.getElementById('reportsContainer');

            // Simulate dynamic report loading
            searchForm.addEventListener('submit', (e) => {
                e.preventDefault();

                const selectedDate = document.getElementById('searchDate').value;
                if (!selectedDate) {
                    reportsContainer.innerHTML = '<p class="text-center text-danger">Please select a valid date.</p>';
                    return;
                }

                // Placeholder for dynamic content
                reportsContainer.innerHTML = `
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Report for ${selectedDate}</h5>
                            <p class="card-text">Detailed report content will be displayed here.</p>
                        </div>
                    </div>
                `;
            });
        </script>
    </div>
</body>
</html>