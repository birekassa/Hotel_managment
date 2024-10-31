<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Panel - Ehototmamachochi Hotel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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

    <!-- Main Content -->
    <div class="container content">
        <div class="jumbotron mt-5 py-5 px-5 rounded"
            style="background-color: rgba(255, 255, 255, 0.9); color: black; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); margin-bottom: 2rem;">
            <h1 class="display-4 text-center font-weight-bold" style="font-size: 2.5rem;">Manager Panel</h1>
        </div>

        <!-- Manager Sections -->
        <div class="container my-4">
            <h2>Show Today's expense , Income and Profit</h2>
            <div class="row">
                <!-- Profit Cards -->
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Today's expense</div>
                        <div class="card-body">
                            <p id="wechi" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Income</div>
                        <div class="card-body">
                            <p id="gebi" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Today's Profit</div>
                        <div class="card-body">
                            <p id="tirf" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manager Sections -->
        <div class="container my-4">
            <h2>Show Prediction of Profit</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Profit After a Week</div>
                        <div class="card-body">
                            <p id="weeklyProfit" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Profit After a Month</div>
                        <div class="card-body">
                            <p id="monthlyProfit" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-header header-blue">Your Profit After a Year</div>
                        <div class="card-body">
                            <p id="yearlyProfit" class="profit-text">Calculating...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript to Calculate Profits -->
        <script>
            const todayProfit = 1000;

            function calculateProfits() {
                const CurrntProfit = todayProfit * 1;
                const weeklyProfit = todayProfit * 7;
                const monthlyProfit = todayProfit * 30;
                const yearlyProfit = todayProfit * 365;

                document.getElementById('weeklyProfit').innerText = `${weeklyProfit} ETB`;
                document.getElementById('monthlyProfit').innerText = `${monthlyProfit} ETB`;
                document.getElementById('yearlyProfit').innerText = `${yearlyProfit} ETB`;
            }

            // Initial calculations on page load
            calculateProfits();
        </script>

        <!-- CSS for Styling -->
        <style>
            .card {
                border-radius: 15px;
                transition: transform 0.2s;
            }

            .card:hover {
                transform: scale(1.02);
            }

            .profit-text {
                font-size: 1.5rem;
            }

            .profit-circle {
                position: relative;
                width: 190px;
                height: 170px;
                border-radius: 50%;
                background-color: #e0e0e0;
                overflow: hidden;
            }

            .profit-percentage {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                margin: 0;
                font-size: 3rem;
                color: blue;
            }

            .header-blue {
                background-color: blue;
                color: white;
            }
        </style>

        <div class="container mt-4">
            <h2>Total Profit in Percent and Hotel Performance</h2>
            <div class="row justify-content-center">
                <!-- Profit in Percent Card -->
                <div class="col-md-6">
                    <div class="card mb-4 shadow" style="height: 250px; border-radius: 15px;">
                        <div class="card-header text-center header-blue">Your Profit in Percent</div>
                        <div class="card-body d-flex align-items-center justify-content-center flex-column">
                            <div class="profit-circle">
                                <div id="profitCircle"
                                    style="position: absolute; bottom: 0; width: 100%; height: 0; background-color: #4caf50; border-radius: 50% 50% 0 0; transition: height 0.5s ease;">
                                </div>
                                <p id="profitPercentage" class="profit-percentage">20%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Performance Card -->
                <div class="col-md-6">
                    <div class="card mb-4 shadow"
                        style="height: 250px; border-radius: 15px; transition: background-color 0.5s ease, color 0.5s ease;">
                        <div class="card-header text-center header-blue">Your Current Performance</div>
                        <div id="performanceCard" class="card-body d-flex align-items-center justify-content-center">
                            <p id="performanceMessage" style="font-size: 2rem;">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    
        <!-- JavaScript to dynamically update the profit percentage -->
        <script>
            let profit = 60; // Example profit percentage

            function updateProfitDisplay() {
                const profitCircle = document.getElementById("profitCircle");
                const profitPercentage = document.getElementById("profitPercentage");
                const performanceCard = document.getElementById("performanceCard");
                const performanceMessage = document.getElementById("performanceMessage");

                // Update circle height and profit percentage
                profitCircle.style.height = `${profit}%`;
                profitPercentage.innerText = `${profit}%`;

                // Update performance message and styles based on profit
                if (profit < 50) {
                    performanceMessage.innerText = "Danger";
                    performanceCard.style.backgroundColor = "#f44336"; // Red
                    performanceCard.style.color = "#ffffff";
                } else if (profit >= 50 && profit < 60) {
                    performanceMessage.innerText = "GOOD";
                    performanceCard.style.backgroundColor = "#ffeb3b"; // Yellow
                    performanceCard.style.color = "#000000";
                } else if (profit >= 60 && profit < 80) {
                    performanceMessage.innerText = "VERY GOOD";
                    performanceCard.style.backgroundColor = "#ff9800"; // Orange
                    performanceCard.style.color = "#ffffff";
                } else {
                    performanceMessage.innerText = "EXCELLENT";
                    performanceCard.style.backgroundColor = "#4caf50"; // Green
                    performanceCard.style.color = "#ffffff";
                }
            }
            // Call the function to set the initial state based on the current profit value
            updateProfitDisplay();
        </script>

        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

        <?php
        // Sample data
        $xValues = ["Tibs", "KiKIl", "Dulet", "Key_wet", "Afagni"];
        $yValues = [55, 49, 44, 24, 15];
        $barColors = ["red", "green", "blue", "orange", "brown"];

        // Convert PHP arrays to JSON format
        $xValuesJson = json_encode($xValues);
        $yValuesJson = json_encode($yValues);
        $barColorsJson = json_encode($barColors);
        ?>

        <script>
            const xValues = <?php echo $xValuesJson; ?>;
            const yValues = <?php echo $yValuesJson; ?>;
            const barColors = <?php echo $barColorsJson; ?>;

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: { display: false },
                    title: { display: true, text: "Foods Profit Graph" }
                }
            });
        </script>
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

        <?php
        // Sample data
        $xValues = ["Tibs", "KiKIl", "Dulet", "Key_wet", "Afagni"];
        $yValues = [55, 49, 44, 24, 15];
        $barColors = ["red", "green", "blue", "orange", "brown"];

        // Convert PHP arrays to JSON format
        $xValuesJson = json_encode($xValues);
        $yValuesJson = json_encode($yValues);
        $barColorsJson = json_encode($barColors);
        ?>

        <script>
            const xValues = <?php echo $xValuesJson; ?>;
            const yValues = <?php echo $yValuesJson; ?>;
            const barColors = <?php echo $barColorsJson; ?>;

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: { display: false },
                    title: { display: true, text: "Foods Profit Graph" }
                }
            });
        </script>
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

        <?php
        // Sample data
        $xValues = ["Tibs", "KiKIl", "Dulet", "Key_wet", "Afagni"];
        $yValues = [55, 49, 44, 24, 15];
        $barColors = ["red", "green", "blue", "orange", "brown"];

        // Convert PHP arrays to JSON format
        $xValuesJson = json_encode($xValues);
        $yValuesJson = json_encode($yValues);
        $barColorsJson = json_encode($barColors);
        ?>

        <script>
            const xValues = <?php echo $xValuesJson; ?>;
            const yValues = <?php echo $yValuesJson; ?>;
            const barColors = <?php echo $barColorsJson; ?>;

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: { display: false },
                    title: { display: true, text: "Foods Profit Graph" }
                }
            });
        </script>
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

        <?php
        // Sample data
        $xValues = ["Tibs", "KiKIl", "Dulet", "Key_wet", "Afagni"];
        $yValues = [55, 49, 44, 24, 15];
        $barColors = ["red", "green", "blue", "orange", "brown"];

        // Convert PHP arrays to JSON format
        $xValuesJson = json_encode($xValues);
        $yValuesJson = json_encode($yValues);
        $barColorsJson = json_encode($barColors);
        ?>

        <script>
            const xValues = <?php echo $xValuesJson; ?>;
            const yValues = <?php echo $yValuesJson; ?>;
            const barColors = <?php echo $barColorsJson; ?>;

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: { display: false },
                    title: { display: true, text: "Foods Profit Graph" }
                }
            });
        </script>
    </div>


    <!-- Footer -->
    <footer
        style="padding: 30px; background-color: #333; color: #f8f9fa; text-align: center; font-family: 'Times New Roman', serif; font-size: 14px; border-top: 3px solid #00c8ff;">
        <p style="margin: 0; line-height: 1;">
            &copy; 2024 EHOTOTMAMACHOCHI HOTEL. All rights reserved.<br>Powered by MTU Department of SE Group 1
            Members
        </p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>