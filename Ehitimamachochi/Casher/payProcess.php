<?php
// Include configuration files
include '../assets/email_config.php';
include '../assets/conn.php';

// Load SweetAlert for user notifications
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

// Function to display SweetAlert messages
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

// Function to send email using PHPMailer
function sendPaymentEmail($email, $salary) {
    $mail = getMailer(); // Load pre-configured PHPMailer instance
    try {
        $mail->setFrom('birekassa1400@gmail.com', 'Ehitimamachochi Hotel');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Payment Processed';
        $mail->Body = "
            Dear Employee,<br><br>
            Your payment of $$salary has been processed.<br><br>
            Best regards,<br>
            Ehitimamachochi Hotel
        ";
        $mail->AltBody = "Dear Employee,\n\nYour payment of $$salary has been processed.\n\nBest regards,\nEhitimamachochi Hotel";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return $e->getMessage(); // Return error message if email fails
    }
}

// Get parameters from POST request and validate
$id = $_POST['id'] ?? '';
$email = $_POST['email'] ?? '';
$salary = $_POST['salary'] ?? '';
$accountNo = $_POST['account_no'] ?? '';

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

// Start a transaction
$mysqli->begin_transaction();

try {
    // Update payment status in the employees table
    $updateQuery = $mysqli->prepare("UPDATE `employees` SET `payment_status` = 1 WHERE `id` = ?");
    if (!$updateQuery) {
        throw new Exception("Failed to prepare update statement: " . $mysqli->error);
    }
    $updateQuery->bind_param("i", $id);
    $updateQuery->execute();

    // Insert deposit record into the bank database
    $writeDeposit = $bankConn->prepare("INSERT INTO `deposit` (`Account_no`, `amount`) VALUES (?, ?)");
    if (!$writeDeposit) {
        throw new Exception("Failed to prepare deposit statement: " . $bankConn->error);
    }
    $writeDeposit->bind_param("sd", $accountNo, $salary);
    $writeDeposit->execute();

    // Commit the transaction
    $mysqli->commit();

    // Send email notification
    $emailResult = sendPaymentEmail($email, $salary);

    if ($emailResult === true) {
        showAlert('success', 'Payment Processed', "Payment of $$salary has been processed, and an email has been sent to $email.", 'payment.php');
    } else {
        showAlert('warning', 'Payment Processed with Errors', "Payment processed, but email sending failed: $emailResult", 'payment.php');
    }
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $mysqli->rollback();
    showAlert('error', 'Transaction Failed', 'Payment processing failed: ' . $e->getMessage());
} finally {
    // Close database connections
    $mysqli->close();
    $bankConn->close();
}
?>
