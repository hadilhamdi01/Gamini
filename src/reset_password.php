<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../vendor/autoload.php";

// Activer ou désactiver les exceptions par variable
$debug = true ;
try {
    // Créer une instance de classe PHPMailer
    $mail = new PHPMailer($debug);

    if ($debug) {
        // donne un journal détaillé
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    }

    // Authentification via SMTP
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    // Connexion
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "hamdihadil51@gmail.com";
    $mail->Password = "pxbo ahio ipde tkuc";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->setFrom('hamdihadil51@gmail.com', 'hadil');
    $mail->addAddress('hamdihadil51@gmail.com', 'nom');

    // $mail->addAttachment("/home/user/Desktop/image.png", "image.png");

    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->isHTML(true);
    $mail->Subject = 'Objet de votre email';
    $mail->Body = 'Le texte de votre email en HTML. Il est également possible des mettre des éléments en <b>gras</b>, par exemple.';
    $mail->AltBody = 'Le texte comme simple élément textuel';

    $mail->send();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: ".$e->getMessage();
}
?>
