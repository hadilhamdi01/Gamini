<?php
include_once 'db_connection.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    $stmt_update_request = $conn->prepare("UPDATE registration_requests SET status = ? WHERE id = ?");
    if ($stmt_update_request === false) {
        die('Erreur de préparation de la requête de mise à jour : ' . $conn->error);
    }

    $bind_update_request = $stmt_update_request->bind_param("si", $status, $id);
    if ($bind_update_request === false) {
        die('Erreur de liaison des paramètres : ' . $stmt_update_request->error);
    }

    $exec_update_request = $stmt_update_request->execute();
    if ($exec_update_request === false) {
        die('Erreur lors de l\'exécution de la requête de mise à jour : ' . $stmt_update_request->error);
    }

    $stmt_update_request->close();

    $stmt_select_request = $conn->prepare("SELECT username, email, ville, titre FROM registration_requests WHERE id = ?");
    if ($stmt_select_request === false) {
        die('Erreur de préparation de la requête de sélection : ' . $conn->error);
    }

    $bind_select_request = $stmt_select_request->bind_param("i", $id);
    if ($bind_select_request === false) {
        die('Erreur de liaison des paramètres : ' . $stmt_select_request->error);
    }

    $exec_select_request = $stmt_select_request->execute();
    if ($exec_select_request === false) {
        die('Erreur lors de l\'exécution de la requête de sélection : ' . $stmt_select_request->error);
    }

    $result_request = $stmt_select_request->get_result();
    $row_request = $result_request->fetch_assoc();
    $stmt_select_request->close();

    $stmt_insert_user = $conn->prepare("INSERT INTO users (username, password, role, email, ville, titre, image) VALUES (?, ?, ?, ?, ?, ?, DEFAULT)");
    if ($stmt_insert_user === false) {
        die('Erreur de préparation de la requête d\'insertion : ' . $conn->error);
    }
    
    $password = password_hash("default_password", PASSWORD_DEFAULT);
    $role = "user";

    $bind_insert_user = $stmt_insert_user->bind_param("ssssss", $row_request['username'], $password, $role, $row_request['email'], $row_request['ville'], $row_request['titre']);
    if ($bind_insert_user === false) {
        die('Erreur de liaison des paramètres : ' . $stmt_insert_user->error);
    }

    $exec_insert_user = $stmt_insert_user->execute();
    if ($exec_insert_user === false) {
        die('Erreur lors de l\'exécution de la requête d\'insertion : ' . $stmt_insert_user->error);
    }

    $stmt_insert_user->close();

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "hamdihadil51@gmail.com";
        $mail->Password = "pxbo ahio ipde tkuc";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('hamdihadil51@gmail.com', 'Admin');
        $mail->addAddress($row_request['email']);

        $mail->isHTML(true);
        $mail->Subject = 'Demande d\'inscription';
        $mail->Body    = "Bonjour " . $row_request['username'] . ",<br><br>Votre demande a été acceptée. Vous devez changer votre mot de passe pour accéder à notre plateforme.<br><br>Cordialement,<br>L'équipe.";

        $mail->send();
        header('Location: index.php');
        exit(); 
    } catch (Exception $e) {
        echo "Statut mis à jour et utilisateur ajouté, mais l'envoi de l'email a échoué. Erreur: {$mail->ErrorInfo}";
    }
} else {
    echo "Requête invalide.";
}

$conn->close();