<?php
include 'db_connect.php'; // Include your database connection file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["reset-username"];
    $email = $_POST["reset-email"];

    // Check if username and email exist in the database
    $sql = "SELECT email FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["email"] == $email) {
            // Send reset link
            $mail = new PHPMailer(true);

            try {
                // SMTP configuration for Gmail
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'fantasyolympic@gmail.com';
                $mail->Password   = 'SilasJacob123';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('fantasyolympic@gmail.com', 'Fantasy Olympic');
                $mail->addAddress($email, $username);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Link';
                
                // Customize the email content with a reset link or instructions
                $resetLink = 'http://yourwebsite.com/reset_password_page.php?token=unique_token';
                $mail->Body    = 'Click <a href="' . $resetLink . '">here</a> to reset your password.';
                
                $mail->AltBody = 'If you cannot view this email, please contact support.';

                $mail->send();
                echo 'Reset link has been sent.';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Email does not match our records.";
        }
    } else {
        echo "Username does not exist.";
    }
    $conn->close();
}
?>
