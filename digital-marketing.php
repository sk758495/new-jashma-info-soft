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
        $mail->setFrom($from_email, 'Hiring Team');
        $mail->addAddress('jashmainfosoftpvtltd@gmail.com');  // Your hiring team email
        $mail->addReplyTo($email, $fullName);

        // Email Body (to you)
        $mail->isHTML(true);
        $mail->Subject = "New Job Application from $fullName";
        $mail->Body = "
        <html>
        <head>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Container styling for email */
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Email header styling */
        .email-header {
            background-color: #f8f8f8;
            text-align: center;
            padding: 20px;
            border-radius: 5px;
        }

        /* Logo styling */
        .email-header img {
            width: 150px;
            height: auto;
            margin-bottom: 15px;
        }

        /* Heading styling */
        .email-header h2 {
            font-size: 24px;
            color: #333;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Email body text styling */
        .email-body {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            margin-top: 20px;
        }

        /* Styling for form details */
        .email-body p {
            font-size: 16px;
            color: #555;
        }

        .email-body p strong {
            color: #333;
        }
    </style>
</head>
        <body>
         <div class='email-container'>
        <div class='email-header' >
                    <img src='$company_logo' alt='Company Logo'>
                    <h2>New Contact Form Submission</h2>
            </div>
            <div class='email-body'>
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
            </div>
            </div>
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
        <head>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Container styling for email */
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Email header styling */
        .email-header {
            background-color: #f8f8f8;
            text-align: center;
            padding: 20px;
            border-radius: 5px;
        }

        /* Logo styling */
        .email-header img {
            width: 150px;
            height: auto;
            margin-bottom: 15px;
        }

        /* Heading styling */
        .email-header h2 {
            font-size: 24px;
            color: #333;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Email body text styling */
        .email-body {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            margin-top: 20px;
        }

        /* Styling for form details */
        .email-body p {
            font-size: 16px;
            color: #555;
        }

        .email-body p strong {
            color: #333;
        }
    </style>
</head>
        <body>
        <div class='email-container'>
        <div class='email-header'>
                    <img src='$company_logo' alt='Company Logo'>
                    <h2>New Contact Form Submission</h2>
                </div>
                <div class='email-body'>
            <p>Dear $fullName,</p>
            <p>Thank you for applying for the $position position. Our team will review your application and contact you shortly.</p>
            <p>Best regards,<br>Hiring Team</p>
            </div>
        </div>
        </body>
        </html>
        ";
        $mail->send();

        echo "Your application has been submitted successfully!";

        echo '<script>
        setTimeout(function(){
            window.location.href = "ui-ux.html"; // Redirect after 3 seconds
        }, 3000);
      </script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>
