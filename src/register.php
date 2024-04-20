<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamini";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nom d'utilisateur et le mot de passe du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête SQL pour insérer l'utilisateur dans la base de données
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);
    if ($stmt->execute()) {
        echo "Utilisateur enregistré avec succès !";
    } else {
        echo "Erreur lors de l'enregistrement de l'utilisateur : " . $conn->error;
    }

    // Fermer la déclaration et la connexion à la base de données
    $stmt->close();
    $conn->close();
}
?>
