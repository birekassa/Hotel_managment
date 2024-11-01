<?php
// Include PHPMailer classes
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//include database connection
include '../../assets/conn.php';

// Initialize message variables
$message = '';
$messageType = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the array of employee IDs and other details
    $ids = $_POST['ids'];
    $f_names = $_POST['f_name'];
    $l_names = $_POST['l_name'];
    $sexes = $_POST['sex'];
    $ages = $_POST['age'];
    $emails = $_POST['email'];
    $phone_nos = $_POST['phone_no'];
    $positions = $_POST['position'];
    $edu_statuses = $_POST['edu_status'];
    $current_documents = $_POST['current_document'];
    $current_kebele_ids = $_POST['current_kebele_id'];

    // Handle file uploads
    $documents = $_FILES['document']['name'];
    $kebele_ids = $_FILES['kebele_id']['name'];

    // Loop through each employee and update their details
    for ($i = 0; $i < count($ids); $i++) {
        $id = $ids[$i];
        $f_name = $f_names[$i];
        $l_name = $l_names[$i];
        $sex = $sexes[$i];
        $age = $ages[$i];
        $email = $emails[$i];
        $phone_no = $phone_nos[$i];
        $position = $positions[$i];
        $edu_status = $edu_statuses[$i];
        $document = $current_documents[$i];
        $kebele_id = $current_kebele_ids[$i];

        // Handle new document upload
        if (!empty($_FILES['document']['name'][$i])) {
            $documentPath = 'uploads/' . basename($_FILES['document']['name'][$i]);
            if (move_uploaded_file($_FILES['document']['tmp_name'][$i], $documentPath)) {
                $document = $documentPath;
            } else {
                $message = "Failed to upload document for employee ID $id.";
                $messageType = 'warning';
                break; // Exit loop on error
            }
        }

        // Handle new kebele ID upload
        if (!empty($_FILES['kebele_id']['name'][$i])) {
            $kebeleIdPath = 'uploads/' . basename($_FILES['kebele_id']['name'][$i]);
            if (move_uploaded_file($_FILES['kebele_id']['tmp_name'][$i], $kebeleIdPath)) {
                $kebele_id = $kebeleIdPath;
            } else {
                $message = "Failed to upload kebele ID for employee ID $id.";
                $messageType = 'warning';
                break; // Exit loop on error
            }
        }

        // Prepare and execute the update query
        $sql = "UPDATE employees SET f_name = ?, l_name = ?, sex = ?, age = ?, email = ?, phone_no = ?, position = ?, edu_status = ?, document = ?, kebele_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", $f_name, $l_name, $sex, $age, $email, $phone_no, $position, $edu_status, $document, $kebele_id, $id);

        if ($stmt->execute()) {
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
                $mail->Subject = 'Your Detail is Updated!';
                $mail->Body = "<p>Dear $f_name $l_name,</p>
                                <p>Your details have been successfully updated.</p>
                                <p>Here is the summary of your updated information:</p>
                                <ul>
                                    <li>Name: $f_name $l_name</li>
                                    <li>Sex: $sex</li>
                                    <li>Age: $age</li>
                                    <li>Email: $email</li>
                                    <li>Phone: $phone_no</li>
                                    <li>Position: $position</li>
                                    <li>Education Status: $edu_status</li>
                                </ul>
                                <p>If you have any questions, feel free to contact us.</p>
                                <p>Best regards,<br>Ehitimamachochi Hotel</p>";
                $mail->AltBody = "Dear $f_name $l_name,\n\nYour details have been successfully updated. Here is the summary of your updated information:\n\nName: $f_name $l_name\nSex: $sex\nAge: $age\nEmail: $email\nPhone: $phone_no\nPosition: $position\nEducation Status: $edu_status\n\nIf you have any questions, feel free to contact us.\n\nBest regards,\nEhitimamachochi Hotel";

                $mail->send();
                $message = 'Employee details updated and email notification sent successfully!';
                $messageType = 'success';
            } catch (Exception $e) {
                $message = "Employee details updated but failed to send email: {$mail->ErrorInfo}";
                $messageType = 'warning';
            }
        } else {
            $message = "Error updating employee with ID $id: " . $conn->error;
            $messageType = 'error';
            break; // Exit loop on error
        }
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
    <title>Update Employees</title>
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
