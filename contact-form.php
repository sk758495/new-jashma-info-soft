<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data from the contact form
    $fullName = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Email Settings
    $smtp_host = 'smtp.gmail.com';  // For Gmail
    $smtp_user = 'jashmainfosoftpvtltd@gmail.com';  // Your Gmail address
    $smtp_pass = 'stfwgxmitvwatwiv';  // Your Gmail password or App Password
    $from_email = 'jashmainfosoftpvtltd@gmail.com';  // Your email address    
    $company_logo = 'https://jashmainfosoft.com//assets/img/jasma-logo-removebg-preview.png';  // Link to your company logo image (absolute URL)

    // PHPMailer setup
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_user;
        $mail->Password = $smtp_pass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($from_email, 'New Contact Form (Jashma InfoSoft Pvt. Ltd.)');
        $mail->addAddress('jashmainfosoftpvtltd@gmail.com');  // Hiring team or recipient email
        $mail->addReplyTo($email, $fullName);

        // Email Body (to you)
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission: $subject";
        $mail->Body = "
        <html>
        <head>
            <style>
                /* General body styling */
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                .email-container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); }
                .email-header { background-color: #f8f8f8; text-align: center; padding: 20px; border-radius: 5px; }
                .email-header img { width: 150px; height: auto; margin-bottom: 15px; }
                .email-header h2 { font-size: 24px; color: #333; margin: 0; font-family: Arial, sans-serif; }
                .email-body { padding: 20px; background-color: #ffffff; border-radius: 5px; margin-top: 20px; }
                .email-body p { font-size: 16px; color: #555; }
                .email-body p strong { color: #333; }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>
                    <img src='$company_logo' alt='Company Logo'>
                    <h2>New Contact Form Submission</h2>
                </div>
                <div class='email-body'>
                    <p><strong>Name:</strong> $fullName</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Subject:</strong> $subject</p>
                    <p><strong>Message:</strong> $message</p>
                </div>
            </div>
        </body>
        </html>
        ";

        // Send email to the recipient (your email)
        $mail->send();

        // Send confirmation email to the applicant
        $customer_subject = "Thank you for contacting us!";
        $mail->clearAddresses();
        $mail->addAddress($email, $fullName);
        $mail->Subject = $customer_subject;
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                .email-container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); }
                .email-header { background-color: #f8f8f8; text-align: center; padding: 20px; border-radius: 5px; }
                .email-header img { width: 150px; height: auto; margin-bottom: 15px; }
                .email-header h2 { font-size: 24px; color: #333; margin: 0; font-family: Arial, sans-serif; }
                .email-body { padding: 20px; background-color: #ffffff; border-radius: 5px; margin-top: 20px; }
                .email-body p { font-size: 16px; color: #555; }
                .email-body p strong { color: #333; }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>
                    <img src='$company_logo' alt='Company Logo'>
                    <h2>Thank You for Contacting Us</h2>
                </div>
                <div class='email-body'>
                    <p>Dear $fullName,</p>
                    <p>Thank you for contacting us. We have received your message and will get back to you shortly.</p>
                    <p>Best regards,<br>Jashma InfoSoft Pvt. Ltd.</p>
                </div>
            </div>
        </body>
        </html>
        ";
        $mail->send();

        echo "Your message has been sent successfully!";
        
        // Optional: Redirect after message is sent
        echo '<script>
        setTimeout(function(){
            window.location.href = "index.html"; // Redirect after 3 seconds
        }, 3000);
        </script>';
        
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>
