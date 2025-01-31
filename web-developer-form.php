<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $position = htmlspecialchars($_POST['position']);
    $qualification = htmlspecialchars($_POST['qualification']);
    $message = htmlspecialchars($_POST['message']);
    $resume = $_FILES['resume'];

    // Optional - Data for experienced users
    $workplace = isset($_POST['workplace']) ? htmlspecialchars($_POST['workplace']) : '';
    $currentCTC = isset($_POST['currentCTC']) ? htmlspecialchars($_POST['currentCTC']) : '';
    $expectedSalary = isset($_POST['expectedSalary']) ? htmlspecialchars($_POST['expectedSalary']) : '';
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';

    // Email Settings
  
    $smtp_host = 'smtp.gmail.com';  // For Gmail
    $smtp_user = 'arjuncableconverters@gmail.com';  // Your Gmail address
    $smtp_pass = 'mtrlfujdiyxxryjz';  // Your Gmail password or App Password
    $from_email = 'arjuncableconverters@gmail.com';  // Your email address    
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
        $mail->setFrom($from_email, 'Hiring Team');
        $mail->addAddress('arjuncableconverters@gmail.com');  // Your hiring team email
        $mail->addReplyTo($email, $fullName);

        // Email Body (to you)
        $mail->isHTML(true);
        $mail->Subject = "New Job Application from $fullName";
        $mail->Body = "
        <html>
        <body>
        <div class='email-header'>
                    <img src='$company_logo' alt='Company Logo'>
                    <h2>New Contact Form Submission</h2>
            </div>
            <p><strong>Name:</strong> $fullName</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Position Applied:</strong> $position</p>
            <p><strong>Qualification:</strong> $qualification</p>
            <p><strong>Message:</strong> $message</p>
            <p><strong>Workplace (if experienced):</strong> $workplace</p>
            <p><strong>Current CTC:</strong> $currentCTC</p>
            <p><strong>Expected Salary:</strong> $expectedSalary</p>
            <p><strong>Address:</strong> $address</p>
        </body>
        </html>
        ";

        // Send email to hiring team
        $mail->send();

        // Send confirmation email to the applicant
        $customer_subject = "Thank you for your application!";
        $mail->clearAddresses();
        $mail->addAddress($email, $fullName);
        $mail->Subject = $customer_subject;
        $mail->Body = "
        <html>
        <body>
        <div class='email-header'>
                    <img src='$company_logo' alt='Company Logo'>
                    <h2>New Contact Form Submission</h2>
                </div>
            <p>Dear $fullName,</p>
            <p>Thank you for applying for the $position position. Our team will review your application and contact you shortly.</p>
            <p>Best regards,<br>Hiring Team</p>
        </body>
        </html>
        ";
        $mail->send();

        echo "Your application has been submitted successfully!";

        echo '<script>
        setTimeout(function(){
            window.location.href = "web-developer.html"; // Redirect after 3 seconds
        }, 3000);
      </script>';

    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>
