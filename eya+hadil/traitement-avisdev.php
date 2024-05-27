<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utilisateur_id = $_POST['utilisateur_id'];
    $sujet = $_POST['sujet'];
    $description = $_POST['description'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gamini";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO avis_dev (utilisateur_id, sujet, description) VALUES ('$utilisateur_id', '$sujet', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Réclamation ajoutée avec succès.";
        header("Location: avisdev.php");
        exit;
    } else {
        echo "Erreur lors de l'ajout de la réclamation: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: formulaire_reclamation.php");
    exit;
}
