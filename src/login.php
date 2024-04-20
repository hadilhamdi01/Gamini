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

    // Préparer et exécuter la requête SQL pour récupérer l'utilisateur de la base de données
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe dans la base de données
    if ($result->num_rows == 1) {
        // Récupérer le mot de passe haché de la base de données
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Vérifier si le mot de passe correspond
        if (password_verify($password, $hashed_password)) {
            // Mot de passe correct, rediriger vers la page de bienvenue ou effectuer d'autres actions
            header("Location: welcome.php");
            exit;
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect";
        }
    } else {
        // L'utilisateur n'existe pas
        echo "Nom d'utilisateur incorrect";
    }

    // Fermer la déclaration et la connexion à la base de données
    $stmt->close();
    $conn->close();
}
?>
