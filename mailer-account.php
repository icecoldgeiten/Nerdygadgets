<?php
$credentials = $_SESSION["credentials"];
$name = $credentials["postal-name"];
$email = $credentials["postal-EmailAddress"];
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$Query = "SELECT CustomerID FROM customer_nl WHERE EmailAddress = ?;";
$statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_bind_param($statement, "i", $email);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
foreach($result as $key => $value){
    $customernumber = $value['CustomerID'];
}




// Load Composer's autoloader
require 'PHPmailer/vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = 'nerdygadgetsf4@gmail.com';                     // SMTP username
    $mail->Password = 'TScjWlUVbKYfD5aBQ^35';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('nerdygadgetsf4@gmail.com', 'NerdyGadgets');
    $mail->addAddress($email);     // Add a recipient
    $mail->addReplyTo('nerdygadgetsf4@gmail.com', 'informatie');
    // Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $body = '<p><strong> Beste ' . $name . ', </strong><br><h1>Bedankt voor het aanmaken van een account op NerdyGadgets!</h1><br>Het account is succesvol aangemaakt!<br>Uw klantnummer is: ' . $customernumber . '.<br>';
    $body .= 'U kunt vanaf nu inloggen op de inlogpagina met het e-mail adres ' . $email . '.<br><br> Tot snel, <br>NerdyGadgets</p>';
    $mail->isHTML(true);
    $mail->Subject = 'Bedankt voor het aanmaken van een account';
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
} catch (Exception $e) {
}
?>
