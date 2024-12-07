<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer's autoloader

if (isset($_POST['submit'])) {
    // Capture form data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phoneNumber']);
    $website = htmlspecialchars($_POST['websiteUrl']);
    $message = htmlspecialchars($_POST['message']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill in all required fields.";
    } else {
        // Create PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com'; // SMTP server (replace with actual)
            $mail->SMTPAuth = true;
            $mail->Username = 'youremail@example.com'; // SMTP username
            $mail->Password = 'yourpassword'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('dunsieman@gmail.com'); // Replace with your email

            // Content
            $mail->isHTML(false); // Set email format to plain text
            $mail->Subject = 'New Message from Contact Form';
            $mail->Body    = "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\nMessage: $message";

            $mail->send();
            echo "Message sent successfully!";
        } catch (Exception $e) {
            echo "There was an error sending the message. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
