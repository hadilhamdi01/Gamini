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
    $email = $_POST["email"];
    $ville = $_POST["ville"];
    $titre = $_POST["titre"];
    $role = 'user';
    $status='pending';


    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête SQL pour insérer l'utilisateur dans la base de données
    $stmt = $conn->prepare("INSERT INTO registration_requests(username, password,email, ville, titre, role, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $username, $hashed_password, $email, $ville, $titre, $role, $status);

    if ($stmt->execute()) {
        echo '<script>alert("Demande d\'inscription soumise avec succès ! Attendez l\'approbation de l\'administrateur.");</script>';
    } else {
        echo '<script>alert("Erreur lors de la soumission de la demande d\'inscription : ' . $conn->error . '");</script>';
    }

    // Fermer la déclaration et la connexion à la base de données
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        .input-field {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

.input-field:focus {
    outline: none;
    border-color: #6E8BFF;
    box-shadow: 0 0 5px #6E8BFF;
}

        </style>
</head>
<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">REGISTER</h1>
                <form action="register.php" method="POST">
                    <input type="text"  name="username" placeholder="USERNAME" />
                    <input type="email"  name="email" placeholder="EMAIL" />
                    <input type="text"  name="ville" placeholder="VILLE" />
                    <select name="titre" class="input-field opacity">
    <option value="developpeur">Développeur</option>
    <option value="joueur">Joueur</option>
</select>

                    <input type="password" name="password" placeholder="PASSWORD" />
                    <button class="opacity" type="submit">SIGN UP</button>
                </form>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>
</html>
