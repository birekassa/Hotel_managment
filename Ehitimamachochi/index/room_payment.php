
<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include mail config connection
include '../assets/email_config.php';

//include database connection
include '../assets/conn.php';

// Function to output SweetAlert2 script
function showAlert($icon, $title, $text) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                text: '$text',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
        });
    </script>";
}

// Generate a unique verification code
function generateVerificationCode($conn) {
    do {
        $code = rand(100000, 999999);
        $sql = "SELECT COUNT(*) FROM reserved_rooms WHERE verification_code = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            showAlert('error', 'Prepare Statement Failed', 'Prepare failed: ' . $conn->error);
            exit();
        }

        $stmt->bind_param("i", $code);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count == 0) {
            break;
        }
    } while (true);

    return $code;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $room_type = $conn->real_escape_string($_POST['room_type']);
    $num_guests = intval($_POST['num_guests']);
    $room_id = intval($_POST['room_id']);
    $room_price = isset($_POST['room_price']) ? floatval($_POST['room_price']) : 0.0;
    $checkin_date = $conn->real_escape_string($_POST['checkin_date']);
    $checkout_date = $conn->real_escape_string($_POST['checkout_date']);
    
    // Generate a unique verification code
    $verification_code = generateVerificationCode($conn);

    // Validate check-in and check-out dates
    $current_date = date('Y-m-d');

    if ($checkin_date < $current_date) {
        showAlert('error', 'Invalid Check-in Date', 'Check-in date cannot be in the past.');
        exit();
    }

    if ($checkout_date <= $checkin_date) {
        showAlert('error', 'Invalid Check-out Date', 'Check-out date must be after the check-in date.');
        exit();
    }

    // Begin MySQL transaction
    $conn->begin_transaction();

    try {
        // Insert reservation data into the database
        $sql = "INSERT INTO reserved_rooms (first_name, last_name, email, phone, room_type, num_guests, room_id, room_price, checkin_date, checkout_date, verification_code) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }

        $stmt->bind_param("sssssiiidss", $first_name, $last_name, $email, $phone, $room_type, $num_guests, $room_id, $room_price, $checkin_date, $checkout_date, $verification_code);

        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        // Update room status to 'occupied'
        $sql_update = "UPDATE table_rooms SET r_status = 'occupied' WHERE r_id = ?";
        $stmt_update = $conn->prepare($sql_update);

        if (!$stmt_update) {
            throw new Exception('Prepare update statement failed: ' . $conn->error);
        }

        $stmt_update->bind_param("i", $room_id);

        if (!$stmt_update->execute()) {
            throw new Exception('Update execute failed: ' . $stmt_update->error);
        }

        $mail = getMailer();

        try {
                // Recipients
                $mail->setFrom('birekassa1400@gmail.com', 'Ehitimamachochi Hotel');
                $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome To Ehitimamachochi Hotel  You Have Sucessful reservation!';
            $mail->Body = "<p>Dear $first_name $last_name, welcome to Ehitimamachochi Hotel!</p>
                        <p>You reserved $room_type rooms.</p>
                        <p>Number of guests: $num_guests</p>
                        <p>Your room ID is: $room_id</p>
                        <p>You paid: $room_price ETB</p>
                        <p>Check-in date: $checkin_date</p>
                        <p>Check-out date: $checkout_date</p>
                        <p><b>Your Code is:</b> <span style='font-size: 24px; font-weight: bold; color: #007BFF;'>$verification_code</span></p>
                        <p>If you have any questions or need further assistance, please contact us at <a href='mailto:contactus@ehitimamachochihotel.com'>contactus@ehitimamachochihotel.com</a>.</p>
                        <p>Thank you for staying with us at Ehitimamachochi Hotel.</p>";

            $mail->AltBody = "Hello $first_name $last_name, welcome to Ehitimamachochi Hotel!\n\n" .
                            "You reserved $room_type rooms.\n" .
                            "Number of guests: $num_guests\n" .
                            "Your room ID is: $room_id\n" .
                            "You paid: $room_price\n" .
                            "Check-in date: $checkin_date\n" .
                            "Check-out date: $checkout_date\n\n" .
                            "Your Code is: $verification_code\n\n" .
                            "If you have any questions or need further assistance, please contact us at contactus@ehitimamachochihotel.com.\n\n" .
                            "Thank you for staying with us at Ehitimamachochi Hotel.";

            $mail->send();
            
            $conn->commit();// Commit the transaction
            showAlert('success', 'Reservation Completed', 'Your reservation has been completed successfully!');
        } catch (Exception $e) {
            showAlert('error', 'Email Sending Failed', 'Failed to send email. Mailer Error: ' . $mail->ErrorInfo);
            exit();
        }
    } catch (Exception $e) {
        // Rollback the transaction on failure
        $conn->rollback();
        showAlert('error', 'Database Error', $e->getMessage());
        exit();
    }

    $stmt->close();
    $stmt_update->close();
    $conn->close();
} else {
    showAlert('error', 'Invalid Request', 'Invalid request method or missing parameters.');
}
?>
