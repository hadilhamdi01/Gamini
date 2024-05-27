<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if(isset($_SESSION['user_id'])) {
    // L'utilisateur est connecté, récupérer son ID
    $user_id = $_SESSION['user_id'];

    // Établir une connexion à la base de données (à remplir avec vos propres informations)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gamini";

    $conn = new mysqli($servername, $username, $password, $database);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Requête SQL pour récupérer les réclamations de l'utilisateur connecté
    $sql = "SELECT reclam_dev.*
            FROM reclam_dev
            INNER JOIN users ON reclam_dev.utilisateur_id = users.id
            WHERE users.id = $user_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Affichage des réclamations
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["sujet"] . "</li>"; // Remplacez "votre_colonne" par le nom de la colonne contenant les réclamations
        }
        echo "</ul>";
    } else {
        echo "Aucune réclamation trouvée pour cet utilisateur.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    // L'utilisateur n'est pas connecté, rediriger vers la page de connexion par exemple
    header("Location: login.php");
    exit();
}

