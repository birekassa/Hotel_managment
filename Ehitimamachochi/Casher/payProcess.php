<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Database connection for employees
$mysqli = new mysqli("localhost", "root", "24770267", "ehms_db");
if ($mysqli->connect_error) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Connection Error',
                text: 'Failed to connect to employee database: " . addslashes($mysqli->connect_error) . "'
            }).then(() => {
                window.history.back();
            });
        });
    </script>";
    exit();
}

// Database connection for bank
$bankConn = new mysqli("localhost", "root", "24770267", "commercial_bank_of_ethiopia");
if ($bankConn->connect_error) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Connection Error',
                text: 'Failed to connect to bank database: " . addslashes($bankConn->connect_error) . "'
            }).then(() => {
                window.history.back();
            });
        });
    </script>";
    exit();
}

echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

// Function to show SweetAlert messages
function showAlert($type, $title, $message, $redirect = '') {
    echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '$type',
                    title: '$title',
                    text: '$message',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if ('$redirect') {
                            window.location.href = '$redirect';
                        } else {
                            window.history.back();
                        }
                    }
                });
            });
        </script>
    ";
}

// Function to configure PHPMailer
function configureMailer($email, $salary) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'birekassa1400@gmail.com'; 
        $mail->Password   = 'miuc evkj fqhx lhxj'; // Store securely (preferably use environment variables)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('birekassa1400@gmail.com', 'Ehitimamachochi Hotel');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Payment Processed';
        $mail->Body    = "Dear Employee,<br><br>Your payment of $$salary has been processed.<br><br>Best regards,<br>Ehitimamachochi Hotel";
        $mail->AltBody = "Dear Employee,\n\nYour payment of $$salary has been processed.\n\nBest regards,\nEhitimamachochi Hotel";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return $e->getMessage(); // Return error message if any
    }
}

// Get parameters from POST request
$id = $_POST['id'] ?? '';
$email = $_POST['email'] ?? '';
$salary = $_POST['salary'] ?? '';
$accountNo = $_POST['account_no'] ?? '';

// Validate input
if (!$id || !$email || !$salary || !$accountNo) {
    showAlert('error', 'Invalid Parameters', 'Required parameters are missing.');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showAlert('error', 'Invalid Email', 'The provided email address is not valid.');
    exit();
}

if (!is_numeric($salary)) {
    showAlert('error', 'Invalid Salary', 'Salary must be a valid number.');
    exit();
}

// Start transactions
$mysqli->begin_transaction();
$bankConn->begin_transaction();

try {
    // Update payment status in employees
    $updateQuery = "UPDATE `employees` SET `payment_status` = 1 WHERE `id` = ?";
    $stmt = $mysqli->prepare($updateQuery);
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $mysqli->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Insert deposit record into the bank database
    $writeDeposit = "INSERT INTO `deposit` (`Account_no`, `amount`) VALUES (?, ?)";
    $stmt = $bankConn->prepare($writeDeposit);
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $bankConn->error);
    }
    $stmt->bind_param("sd", $accountNo, $salary);
    $stmt->execute();

    // Commit transactions
    $mysqli->commit();
    $bankConn->commit();

    // Send email notification
    $emailResult = configureMailer($email, $salary);

    if ($emailResult === true) {
        showAlert('success', 'Payment Processed', "Payment of $$salary has been processed, and an email has been sent to $email.", 'payment.php');
    } else {
        showAlert('warning', 'Payment Processed with Errors', "Payment processed, but email sending failed: $emailResult", 'payment.php');
    }

} catch (Exception $e) {
    // Rollback transactions if an error occurs
    $mysqli->rollback();
    $bankConn->rollback();
    showAlert('error', 'Transaction Failed', 'Payment processing failed: ' . $e->getMessage());
}

// Close database connections
$mysqli->close();
$bankConn->close();
?>
