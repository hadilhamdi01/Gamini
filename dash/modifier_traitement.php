<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Récupérer les données du formulaire
$id = $_POST['id'];
$nom_utilisateur = $_POST['username']; // Utilisez une variable distincte pour le nom d'utilisateur
$email = $_POST['email'];
$ville = $_POST['ville'];
$role = $_POST['role'];
$titre = $_POST['titre'];


    // Établir une connexion à la base de données
    $servername = "localhost"; // Nom du serveur MySQL
    $username = "root"; // Nom d'utilisateur MySQL
    $password = ""; // Mot de passe MySQL
    $dbname = "gamini"; // Nom de la base de données

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Requête SQL pour mettre à jour l'utilisateur
    $sql = "UPDATE users SET username='$nom_utilisateur', email='$email', ville='$ville', role='$role', titre='$titre' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Rediriger vers la page liste des utilisateurs après la modification
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
