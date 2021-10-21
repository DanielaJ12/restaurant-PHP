<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();         
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                                   //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'daniela.jeleascov@gmail.com';                     //SMTP username
    $mail->Password   = 'bucuresti1999';                               //SMTP password
	$mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('no-replay@restaurant.com', 'Restaurant');
    $mail->addAddress('daniela.jeleascov@gmail.com', 'Main admin');     //Add a recipient

    //Content
    $mail->WordWrap = 50; 
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Recuperarea Contului';
    $mail->Body    = 'Ați solicitat recuperarea contului. <br> Pentru a vă reseta parola faceți click <a href="http://localhost/biblioteca%20online/pagini/login.php">aici</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>