<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
if(isset($_POST['newContact'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $message = $_POST['message'];

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'localhost';
    $mail->SMTPAuth = false;
    $mail->SMTPAutoTLS = false;
    $mail->Port = 25;
    $mail->Username = 'thebratpack@alexaperezg.com';
    $mail->Password = 'bratpackdaycare';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    //Recipients
    $mail->setFrom('thebratpack@alexaperezg.com', 'The Brat Pack: Daycare System');
    $mail->addAddress($email, $first_name);     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'The Brat Pack: Daycare System - Contact Form Submitted';
    $mail->Body = '<p>Thanks for filling out our contact form.</p>' .
        '<p>We would like to confirm the following information is correct.</p>' .
        '<p>Name: </p>' . $first_name . ' ' . $last_name .
        '<p>Phone Number: </p>' . $phone_number .
        '<p>Message: </p>' . $message .
        '<p>Sincerely,</p>' .
        '<p>The Brat Pack: Daycare System</p>';

    $mail->send();

    if(!$mail->send()) {
        throw new Exception('Error sending email: ' .
            htmlspecialchars($mail->ErrorInfo) );
    }
    echo 'Message has been sent';
} else {
    echo 'Email was not sent.';
}



