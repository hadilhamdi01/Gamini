<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../vendor/autoload.php";

function generateRandomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'adresse e-mail du formulaire
    $to = $_POST['email'];
    $nouveauMotDePasse = generateRandomPassword();

    try {
        // Créer une instance de classe PHPMailer
        $mail = new PHPMailer(true);

        // Authentification via SMTP
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        // Connexion
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = "hamdihadil51@gmail.com";
        $mail->Password = "pxbo ahio ipde tkuc";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->setFrom('hamdihadil51@gmail.com', 'Admin');
        $mail->addAddress($to);

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->isHTML(true);
        $mail->Subject = 'Réinitialisation de mots de passe';
        $mail->Body = 'Votre nouveau mot de passe est : ' . $nouveauMotDePasse;
        $mail->AltBody = 'Le texte comme simple élément textuel';

        // Essayez d'envoyer l'e-mail
        $mail->send();

        // Si l'e-mail est envoyé avec succès, renvoyer une réponse JSON
        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        // Si une erreur survient lors de l'envoi de l'e-mail, renvoyer une réponse JSON avec un message d'erreur
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi de l\'e-mail']);
    }
    exit; // Arrêtez l'exécution du script PHP après avoir renvoyé la réponse JSON
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>My HTML Page</title>
</head>

<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">Réinitialiser</h1>
                <form id="resetForm">
                    <input type="email" name="email" placeholder="Email" />
                    <button class="opacity" type="submit">Réinitialiser</button>
                </form>
                <div class="register-forget opacity"></div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('resetForm');

        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            const formData = new FormData(form);

            try {
                const response = await fetch('reset_password_form.php', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    const result = await response.json();
                    console.log(result); // Vérifiez les données reçues
                    if (result.success) {
                        // Afficher une alerte si l'e-mail a été envoyé avec succès
                        alert('L\'email a été envoyé avec succès.');
                        // Réinitialiser le formulaire
                        form.reset();
                    } else {
                        alert('Erreur lors de l\'envoi de l\'e-mail.');
                    }
                } else {
                    throw new Error('Erreur de réseau');
                }
            } catch (error) {
                console.error('Une erreur est survenue :', error);
            }
        });
    });
</script>

</body>
</html>
