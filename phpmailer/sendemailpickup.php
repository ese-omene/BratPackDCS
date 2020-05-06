<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
if(isset($_POST['newPickupSchedule'])) {
    $child_first_name = $_POST['child_first_name'];
    $child_last_name = $_POST['child_last_name'];
    $pickup_first_name = $_POST['pickup_first_name'];
    $pickup_last_name = $_POST['pickup_last_name'];
    $pickup_email = $_POST['pickup_email'];
    $pickup_phone_number = $_POST['pickup_phone_number'];
    $date = $_POST['date'];

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
    $mail->addAddress($pickup_email, $pickup_first_name);     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'The Brat Pack: Daycare System - Student Pickup Form Submitted';
    $mail->Body = '<p>You have been set as the person to pickup a student.</p>' .
        '<p>We would like to confirm the following information is correct.</p>' .
        '<p>Child Name: </p>' . $child_first_name . ' ' . $child_last_name .
        '<p>Pickup Name: </p>' . $pickup_first_name . ' ' . $pickup_last_name .
        '<p>Phone Number: </p>' . $pickup_phone_number .
        '<p>Date: </p>' . $date .
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
