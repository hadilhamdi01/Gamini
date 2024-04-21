<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure la bibliothèque PHPMailer autoload.php
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'adresse e-mail du formulaire
    $to = $_POST['email'];

    // Créer une instance de PHPMailer
    $mail = new \SendGrid\Mail\Mail();

    try {
        // Paramètres SMTP de SendGrid
        $mail->isSMTP();
        $mail->Host = 'smtp.sendgrid.net';
        $mail->SMTPAuth = true;
        $mail->Username = 'hamdihadil51@gmail.com';
        $mail->Password = 'Hamdihadil12*#*#';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Paramètres de l'e-mail
        $mail->setFrom('hamdihadil51@gmail.com', 'admin');
        $mail->addAddress($to);
        $mail->Subject = 'Test d\'envoi d\'e-mail via SendGrid';
        $mail->Body = 'Ceci est un test d\'envoi d\'e-mail via SendGrid.';
        $sendgrid= new \SendGrid(getenv("SENDGRID_API_KEY"));

        try{
        // Envoyer l'e-mail
       // $mail->send();
       $response = $sendgrid->send($email);
       print $response->statusCode();
       print-r($response->headers());
       print $response->body() . "\n";

        }
        catch(Exception $e){
            echo 'exc' . $e->getMessage() . "\n";

        }
        echo 'L\'e-mail a été envoyé avec succès.';
    } catch (Exception $e) {
        echo 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
    }
}

?>
