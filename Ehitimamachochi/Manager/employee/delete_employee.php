<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//include database connection
include '../../assets/conn.php';

$message = '';
$messageType = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['id'];

    // Fetch the employee's email and name before deletion
    $sql = "SELECT f_name, l_name, email FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $stmt->bind_result($f_name, $l_name, $email);
    $stmt->fetch();
    $stmt->close();

    // If employee exists, proceed with deletion
    if ($email) {
        // Prepare the delete query
        $sql = "DELETE FROM employees WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $employee_id);

        if ($stmt->execute()) {
            $message = "Employee with ID $employee_id was deleted successfully.";
            $messageType = 'success';

            // Initialize PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'birekassa1400@gmail.com';
                $mail->Password   = 'miuc evkj fqhx lhxj'; // Use an app password or secure method
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('birekassa1400@gmail.com', 'Ehitimamachochi Hotel');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'You are removed from the system!';
                $mail->Body    = "<p>Dear $f_name $l_name,</p>
                                    <p>We regret to inform you that you have been removed from our system.</p>
                                    <p>If you have any questions, feel free to contact us.</p>
                                    <p>Best regards,<br>Ehitimamachochi Hotel</p>";
                $mail->AltBody = "Dear $f_name $l_name,\n\nWe regret to inform you that you have been removed from our system.\n\nIf you have any questions, feel free to contact us.\n\nBest regards,\nEhitimamachochi Hotel";

                $mail->send();

            } catch (Exception $e) {
                $message = "Employee deleted, but email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                $messageType = 'error';
            }

        } else {
            $message = "Error deleting employee with ID $employee_id: " . $conn->error;
            $messageType = 'error';
        }
    } else {
        $message = "Employee with ID $employee_id not found.";
        $messageType = 'error';
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php if (!empty($message)) : ?>
    <script>
        Swal.fire({
            icon: '<?php echo $messageType; ?>',
            title: '<?php echo ucfirst($messageType); ?>',
            text: '<?php echo $message; ?>',
        }).then((result) => {
            if (result.isConfirmed) {
                window.history.back();
            }
        });
    </script>
<?php endif; ?>

</body>
</html>
