<?php
$credentials = $_SESSION["credentials"];
$name = $credentials["postal-name"];
$email = $credentials["postal-EmailAddress"];
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPmailer/vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'nerdygadgetsf4@gmail.com';                     // SMTP username
    $mail->Password   = 'TScjWlUVbKYfD5aBQ^35';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('nerdygadgetsf4@gmail.com', 'NerdyGadgets');
    $mail->addAddress($email);     // Add a recipient
    $mail->addReplyTo('nerdygadgetsf4@gmail.com', 'Information');
    // Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $body = '<p><strong> Beste '. $name . ' Bedankt dat u koos voor NerdyGadgets wij gaan direct aan de slag </strong><br> De verachte bezorgdatum is php stukje  Uw bestelling is verwerkt de verwachte aankomst dag = </p>';
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Uw bestelling';
    $mail->Body    =  $body;
    $mail->AltBody =  strip_tags($body);

    $mail->send();
} catch (Exception $e) {
}
?>
