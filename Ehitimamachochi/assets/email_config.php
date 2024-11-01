<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// Configure PHPMailer
function getMailer() {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'birekassa1400@gmail.com';
        $mail->Password   = 'miuc evkj fqhx lhxj'; // Use app-specific password for Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Set default "From" address
        $mail->setFrom('birekassa1400@gmail.com', 'Ehitimamachochi Hotel');

        return $mail;
    } catch (Exception $e) {
        error_log("Mail configuration failed: " . $e->getMessage());
        throw $e;
    }
}
?>
