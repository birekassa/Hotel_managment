<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inventory - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .navbar {
            margin-bottom: 0;
            background-color: #343a40;
        }

        .navbar-nav .nav-link {
            color: white !important;
        }

        .inventory-section {
            margin: 2rem 0;
        }

        .add-item-section, .update-stock-section {
            margin-top: 3rem;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: relative;
            bottom: 0;
        }

        .table-responsive {
            margin-top: 2rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="Dashboard.php">
                            <i class="bi bi-house-door me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Overview.php">
                            <i class="bi bi-grid me-2"></i>Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="View Inventory.php">
                            <i class="bi bi-list-ul me-2"></i>View Inventory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Sales Reports.php">
                            <i class="bi bi-bar-chart-line me-2"></i>Sales Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Staff Details.php">
                            <i class="bi bi-person me-2"></i>Staff Details
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="Account Settings.php">Account Settings</a></li>
                            <li><a class="dropdown-item" href="System Settings.php">System Settings</a></li>
                            <li><a class="dropdown-item" href="Log out.php">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="inventory-section mt-5">
            <h1 class="display-4 text-center font-weight-bold">View Inventory</h1>
            <p class="text-center">Review the current inventory levels and manage stock.</p>

            <!-- Inventory Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Quantity Available</th>
                            <th>Unit Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>Red Wine</td>
                            <td>Beverages</td>
                            <td>24</td>
                            <td>$15.00</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>White Wine</td>
                            <td>Beverages</td>
                            <td>12</td>
                            <td>$12.00</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                        </tr>
                        <tr>
                            <td>103</td>
                            <td>Chicken Wings</td>
                            <td>Food</td>
                            <td>50</td>
                            <td>$8.00</td>
                            <td><span class="badge bg-success">In Stock</span></td>
                        </tr>
                        <tr>
                            <td>104</td>
                            <td>Beer</td>
                            <td>Beverages</td>
                            <td>0</td>
                            <td>$5.00</td>
                            <td><span class="badge bg-danger">Out of Stock</span></td>
                        </tr>
                        <tr>
                            <td>105</td>
                            <td>Chocolate Cake</td>
                            <td>Desserts</td>
                            <td>8</td>
                            <td>$4.00</td>
                            <td><span class="badge bg-warning">Low Stock</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add New Item Section -->
        <div class="add-item-section mt-5">
            <h2>Add New Item</h2>
            <form>
                <div class="mb-3">
                    <label for="itemName" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="itemName" placeholder="Enter item name">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category">
                        <option selected>Select category</option>
                        <option value="Beverages">Beverages</option>
                        <option value="Food">Food</option>
                        <option value="Desserts">Desserts</option>
                        <!-- Add more categories as needed -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" placeholder="Enter quantity available">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Unit Price</label>
                    <input type="text" class="form-control" id="price" placeholder="Enter unit price">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status">
                        <option selected>Select status</option>
                        <option value="In Stock">In Stock</option>
                        <option value="Out of Stock">Out of Stock</option>
                        <option value="Low Stock">Low Stock</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Item</button>
            </form>
        </div>

        <!-- Update Stock Section -->
        <div class="update-stock-section mt-5">
            <h2>Update Stock</h2>
            <form>
                <div class="mb-3">
                    <label for="itemSelect" class="form-label">Select Item</label>
                    <select class="form-select" id="itemSelect">
                        <option selected>Select item to update</option>
                        <option value="101">Red Wine</option>
                        <option value="102">White Wine</option>
                        <option value="103">Chicken Wings</option>
                        <option value="104">Beer</option>
                        <option value="105">Chocolate Cake</option>
                        <!-- Add more items as needed -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="newQuantity" class="form-label">New Quantity</label>
                    <input type="number" class="form-control" id="newQuantity" placeholder="Enter new quantity">
                </div>
                <div class="mb-3">
                    <label for="newStatus" class="form-label">New Status</label>
                    <select class="form-select" id="newStatus">
                        <option selected>Select new status</option>
                        <option value="In Stock">In Stock</option>
                        <option value="Out of Stock">Out of Stock</option>
                        <option value="Low Stock">Low Stock</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Stock</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Ehototmamachochi Hotel. All rights reserved. Powered by MTU Department of SE Group 1 Members</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
