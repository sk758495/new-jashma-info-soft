<?php
// Include the PHPMailer class
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer library
require 'vendor/autoload.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Email settings (SMTP)
    $smtp_host = 'smtp.gmail.com';  // For Gmail
    $smtp_port = 587;  // For TLS
    $smtp_user = 'arjuncableconverters@gmail.com';  // Your Gmail address
    $smtp_pass = 'mtrlfujdiyxxryjz';  // Your Gmail password or App Password
    $from_email = 'arjuncableconverters@gmail.com';  // Your email address
    $company_logo = 'https://jashmainfosoft.com//assets/img/jasma-logo-removebg-preview.png';  // Link to your company logo image (absolute URL)

    // Set up PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_user;
        $mail->Password = $smtp_pass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $smtp_port;

            // Debugging output
        $mail->SMTPDebug = 2;  // This will output detailed debug information
        $mail->Debugoutput = 'html';


        // Recipients
        $mail->setFrom($from_email, 'Jashma Info Soft');
        $mail->addAddress('arjuncableconverters@gmail.com', 'Dhanji Bharwad'); // Add your email address
        $mail->addReplyTo($email, $name);  // Reply to the customer's email

        // Content (email to you)
        $mail->isHTML(true);
        $mail->Subject = "(Jashma) New Message from Contact Form: $subject";
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .email-content { border: 1px solid #ddd; padding: 20px; border-radius: 5px; }
                .email-header { background-color: #f8f8f8; padding: 10px; text-align: center; border-radius: 5px; }
                .email-header img { width: 150px; }
                .email-body { margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class='email-content'>
                <div class='email-header'>
                    <img src='$company_logo' alt='Company Logo'>
                    <h2>New Contact Form Submission</h2>
                </div>
                <div class='email-body'>
                    <h3>Form Details:</h3>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Subject:</strong> $subject</p>
                    <p><strong>Message:</strong> $message</p>
                </div>
            </div>
        </body>
        </html>
        ";

        // Send email to you
        $mail->send();

        // Send a confirmation email to the customer
        $customer_subject = "Thank you for contacting us!";
        $mail->clearAddresses();  // Clear the previous recipient
        $mail->addAddress($email, $name);  // Send the reply to the customer's email
        $mail->Subject = $customer_subject;
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .email-content { border: 1px solid #ddd; padding: 20px; border-radius: 5px; }
                .email-header { background-color: #f8f8f8; padding: 10px; text-align: center; border-radius: 5px; }
                .email-header img { width: 150px; }
                .email-body { margin-top: 20px; }
            </style>
        </head>
        <body>
            <div class='email-content'>
                <div class='email-header'>
                    <img src='$company_logo' alt='Company Logo'>
                    <h2>Thank You for Your Message!</h2>
                </div>
                <div class='email-body'>
                    <p>Dear $name,</p>
                    <p>Thank you for reaching out to us. We have received your message and our team will get back to you as soon as possible.</p>
                    <p>If your inquiry is urgent, please contact us directly at our phone number.</p>
                    <p>Best regards,<br>Your Company Team</p>
                </div>
            </div>
        </body>
        </html>
        ";

        // Send confirmation email to the customer
        $mail->send();
        echo "Your message has been sent successfully. Thank you for reaching out to us!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
