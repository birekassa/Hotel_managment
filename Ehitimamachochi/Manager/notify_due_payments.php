<?php
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

// Fetch employees whose payment is due today
$sql = "SELECT id, f_name, l_name, reg_date 
        FROM employees 
        WHERE DATEDIFF(CURDATE(), reg_date) % 30 = 0 
        AND payment_status = 'Not Paid'";
$result = $conn->query($sql);

// Generate notification
$notifications = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

// Close connection
$conn->close();

// Display notifications
if (!empty($notifications)) {
    foreach ($notifications as $employee) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
        echo "Payment due today for Employee ID: " . $employee["id"] . ", " . $employee["f_name"] . " " . $employee["l_name"];
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        echo "</div>";
    }
} else {
    echo "<div class='alert alert-info' role='alert'>No payments are due today.</div>";
}
?>