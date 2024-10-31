<?php

include 'conn.php';

// Retrieve username, password, and position from the form
$user_username = $_POST['username'];
$user_password = $_POST['password'];
$user_position = $_POST['position'];

// Initialize error message
$error_message = '';

// Prepare and execute statement to check username and retrieve password and position
$stmt = $conn->prepare("SELECT password, position, is_present FROM employees WHERE username = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $user_username);
$stmt->execute();
$stmt->store_result();

// Check if username exists
if ($stmt->num_rows === 0) {
    $error_message = 'Username not found';
} else {
    // Bind result and fetch values
    $stmt->bind_result($db_password, $db_position, $is_present);
    $stmt->fetch();

    // Verify password
    if (!password_verify($user_password, $db_password)) {
        $error_message = 'Incorrect password';
    } elseif ($user_position !== $db_position) {
        // Verify position
        $error_message = 'Incorrect position';
    } elseif ($is_present !== 'yes') {
        // Verify attendance
        $error_message = 'Access denied. Your attendance is marked as absent.';
    } else {
        // If all checks pass, redirect based on position
        header("Location: ../$user_position/index.php");
        exit();
    }
}

// Output SweetAlert2 for error message
echo "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '$error_message',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php';
            }
        });
    });
</script>
";

// Close statement and connection
$stmt->close();
$conn->close();
?>
