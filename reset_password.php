<?php
include 'db_connect.php';
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
                //Server settings
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.example.com';                     
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = 'your-email@example.com';               
                $mail->Password   = 'your-password';                        
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;                                    

                //Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress($email, $username);     

                // Content
                $mail->isHTML(true);                                  
                $mail->Subject = 'Password Reset Link';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

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
