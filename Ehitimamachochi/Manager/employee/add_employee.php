<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include database connection
include '../../assets/conn.php';

// Ensure the upload directories exist
if (!file_exists('uploads/documents/')) {
    mkdir('uploads/documents/', 0777, true);
}

if (!file_exists('uploads/kebele_ids/')) {
    mkdir('uploads/kebele_ids/', 0777, true);
}

// Function to generate a random username
function generateUsername($length = 12) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomUsername = '';
    for ($i = 0; $i < $length; $i++) {
        $randomUsername .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomUsername;
}

// Function to generate a random password
function generatePassword($length = 4) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomPassword;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $position = $_POST['position'];
    $edu_status = $_POST['edu_status'];
    
    $document = $_FILES['document'];
    $kebele_id = $_FILES['kebele_id'];

    // Validate file uploads
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
    if (!in_array($document['type'], $allowedTypes) || !in_array($kebele_id['type'], $allowedTypes)) {
        $message = "Invalid file type.";
        $messageType = 'error';
    } elseif ($document['size'] > 5000000 || $kebele_id['size'] > 5000000) { // 5MB max file size
        $message = "File size too large.";
        $messageType = 'error';
    } else {
        // Check if email or phone number already exists
        $stmt = $conn->prepare("SELECT * FROM employees WHERE f_name = ? OR phone_no = ?");
        $stmt->bind_param('ss', $f_name, $phone_no);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $message = "An employee already exists.";
            $messageType = 'error';
        } else {
            // Generate username and password
            $username = generateUsername(8);
            $password = generatePassword(6);
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Handle file uploads
            $document_path = 'uploads/documents/' . basename($document['name']);
            $kebele_id_path = 'uploads/kebele_ids/' . basename($kebele_id['name']);
            
            if (move_uploaded_file($document['tmp_name'], $document_path) && move_uploaded_file($kebele_id['tmp_name'], $kebele_id_path)) {
                // Insert data into the employees table
                $stmt = $conn->prepare("INSERT INTO employees (f_name, l_name, sex, age, email, phone_no, position, edu_status, document, kebele_id, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param('ssssssssssss', $f_name, $l_name, $sex, $age, $email, $phone_no, $position, $edu_status, $document_path, $kebele_id_path, $username, $hashed_password);

                if ($stmt->execute()) {
                    // Send a welcome email to the employee
                    require 'vendor/autoload.php'; // Include the Composer autoload file
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
                        $mail->Subject = 'Welcome to Ehitimamachochi Hotel!';
                        $mail->Body = "<p>Dear $f_name $l_name, welcome to Ehitimamachochi Hotel!</p>
                            <p>Your username: <b><span style='color:blue;'>$username</span></b></p>
                            <p>Your password: <b><span style='color:blue;'>$password</span></b></p>
                            <p>Thank you for joining our team.</p>";

                        $mail->AltBody = "Hello $f_name $l_name, welcome to Ehitimamachochi Hotel!\n\n" .
                                        "Your username: $username\n" .
                                        "Your password: $password\n" .
                                        "Thank you for joining our team.";

                        $mail->send();

                        // Success message
                        $message = "Employee registered successfully.";
                        $messageType = 'success';
                    } catch (Exception $e) {
                        $message = "Email could not be sent to $email. Mailer Error: {$mail->ErrorInfo}";
                        $messageType = 'error';
                    }
                } else {
                    $message = "Error registering employee: " . $stmt->error;
                    $messageType = 'error';
                }

                $stmt->close();
            } else {
                $message = "Error uploading files.";
                $messageType = 'error';
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
    <!-- Include any necessary stylesheets or scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <!-- Display SweetAlert2 messages -->
    <?php if (!empty($message)) : ?>
        <script>
            Swal.fire({
                icon: '<?php echo $messageType; ?>',
                title: '<?php echo ucfirst($messageType); ?>',
                text: '<?php echo $message; ?>',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Go back to the previous page after clicking "OK"
                    window.history.back();
                }
            });
        </script>
    <?php endif; ?>


    <!-- Your form goes here -->
</body>
</html>
