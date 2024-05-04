<?php
// Vérifier si l'ID de l'utilisateur à supprimer a été transmis
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur à supprimer
    $id = $_GET['id'];

    // Établir une connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gamini";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Requête SQL pour supprimer l'utilisateur
    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Rediriger vers la page liste des utilisateurs après la suppression
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    echo "ID de l'utilisateur non spécifié.";
}
?>
