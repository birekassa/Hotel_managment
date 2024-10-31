
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $email = trim($_POST['my_update_email']);
    $verification_code = trim($_POST['my_update_password']);
    $room_type = trim($_POST['my_update_room_type']);
    $room_id = trim($_POST['my_update_room_id']);
    $room_price = trim($_POST['my_update_room_price']);
    $checkin_date = trim($_POST['my_update_checkin_date']);
    $checkout_date = trim($_POST['my_update_checkout_date']);

    // Check if reservation exists and fetch the necessary details
    $sql = "SELECT first_name, last_name, room_type, room_id, room_price, checkin_date, checkout_date FROM reserved_rooms WHERE email = ? AND verification_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the reservation details
        $reservation = $result->fetch_assoc();
        $first_name = $reservation['first_name'];
        $last_name = $reservation['last_name'];
        $old_room_type = $reservation['room_type'];
        $old_room_id = $reservation['room_id'];
        $old_room_price = $reservation['room_price'];
        $old_checkin_date = $reservation['checkin_date'];
        $old_checkout_date = $reservation['checkout_date'];

        // Check if there are changes to update
        if ($room_type !== $old_room_type || $room_id !== $old_room_id || $room_price !== $old_room_price || $checkin_date !== $old_checkin_date || $checkout_date !== $old_checkout_date) {
            // Begin transaction
            $conn->begin_transaction();

            try {
                // Update the reservation
                $sql_update = "UPDATE reserved_rooms 
                               SET room_type = ?, room_id = ?, room_price = ?, checkin_date = ?, checkout_date = ?
                               WHERE email = ? AND verification_code = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("sssssss", $room_type, $room_id, $room_price, $checkin_date, $checkout_date, $email, $verification_code);

                if (!$stmt_update->execute()) {
                    throw new Exception("Failed to update reservation.");
                }

                // Log the update
                $sql_log = "INSERT INTO updated_room_reservation (room_type, room_id, room_price, checkin_date, checkout_date)
                            VALUES (?, ?, ?, ?, ?)";
                $stmt_log = $conn->prepare($sql_log);
                $stmt_log->bind_param("sssss", $room_type, $room_id, $room_price, $checkin_date, $checkout_date);

                if (!$stmt_log->execute()) {
                    throw new Exception("Failed to log the update.");
                }

                // Send email with PHPMailer
                $mail = new PHPMailer(true);
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'birekassa1400@gmail.com';
                $mail->Password   = 'miuc evkj fqhx lhxj';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('birekassa1400@gmail.com', 'Ehitimamachochi Hotel');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Reservation Updated';
                $mail->Body = "<p>Dear $first_name $last_name,</p>
                                <p>Your reservation has been successfully updated.</p>
                                <p><strong>Room Type:</strong> $room_type<br>
                                <strong>Room ID:</strong> $room_id<br>
                                <strong>Check-in Date:</strong> $checkin_date<br>
                                <strong>Check-out Date:</strong> $checkout_date<br>
                                <strong>You have paid:</strong> $room_price ETB</p>
                                <p>If you have any questions or need further assistance, please contact us at <a href='mailto:contactus@ehitimamachochihotel.com'>contactus@ehitimamachochihotel.com</a>.</p>
                                <p>Thank you for staying with us at Ehitimamachochi Hotel.</p>";

                $mail->AltBody = "Dear $first_name $last_name,\n\nYour reservation has been successfully updated.\n\nRoom Type: $room_type\nRoom ID: $room_id\nCheck-in Date: $checkin_date\nCheck-out Date: $checkout_date\nYou have paid: $room_price ETB\n\nIf you have any questions or need further assistance, please contact us at contactus@ehitimamachochihotel.com.\n\nThank you for staying with us at Ehitimamachochi Hotel.";

                if (!$mail->send()) {
                    throw new Exception("Failed to send email. Mailer Error: " . $mail->ErrorInfo);
                }

                // Commit the transaction after the email is successfully sent
                $conn->commit();
                showMessage('success', 'Success!', 'Reservation updated successfully!');
            } catch (Exception $e) {
                // Rollback the transaction on failure
                $conn->rollback();
                showMessage('error', 'Error', $e->getMessage());
            }
        } else {
            showMessage('info', 'No Change', 'No changes detected in the reservation.');
        }
    } else {
        // Reservation not found
        showMessage('error', 'Error', 'Reservation not found.');
    }

    $stmt->close();
    $conn->close();
}

// Function to display SweetAlert messages
function showMessage($icon, $title, $message)
{
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: '$icon',
                      title: '$title',
                      text: '$message',
                      confirmButtonText: 'OK'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          window.history.back();
                      }
                  });
              });
          </script>";
}
?>
