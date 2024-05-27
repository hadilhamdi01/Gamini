<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gamini";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Récupérer le nom d'utilisateur et le mot de passe du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Requête SQL pour récupérer l'utilisateur de la base de données
    $stmt = $conn->prepare("SELECT id, username, password, titre, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $loginStatus = "failure";
    $userId = null;

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Vérifier si le mot de passe correspond
        if (password_verify($password, $hashed_password)) {
            // Mot de passe correct, enregistrer les informations de l'utilisateur dans la session
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];

            // Enregistrer l'historique de la connexion
            $userId = $row["id"];
            $loginStatus = "success";

            // Enregistrer l'historique de la connexion (succès)
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $loginTime = date('Y-m-d H:i:s');

            $historyStmt = $conn->prepare("INSERT INTO login_history (user_id, username, login_time, ip_address, user_agent, login_status) VALUES (?, ?, ?, ?, ?, ?)");
            $historyStmt->bind_param("isssss", $userId, $username, $loginTime, $ipAddress, $userAgent, $loginStatus);
            $historyStmt->execute();
            $historyStmt->close();

            // Rediriger en fonction du rôle de l'utilisateur
            if ($row["role"] == "admin") {
                header("Location: ../dash/index.php");
            } else if ($row["role"] == "user") {
                if ($row["titre"] == "developpeur") {
                    header("Location: ../eya+hadil/devlopeur.html");
                } else if ($row["titre"] == "joueur") {
                    header("Location: ../eya+hadil/joueur.html");
                } else {
                    header("Location: ../eya+hadil/portfolio.html");
                }
            }
            exit();
        }
    }

    // Enregistrer l'historique de la connexion (échec)
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $loginTime = date('Y-m-d H:i:s');

    $historyStmt = $conn->prepare("INSERT INTO login_history (user_id, username, login_time, ip_address, user_agent, login_status) VALUES (?, ?, ?, ?, ?, ?)");
    $historyStmt->bind_param("isssss", $userId, $username, $loginTime, $ipAddress, $userAgent, $loginStatus);
    $historyStmt->execute();
    $historyStmt->close();

    $error_message = "Nom d'utilisateur ou mot de passe incorrect";

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
    <title>My HTML Page</title>
</head>
<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">Connexion</h1>
                <form action="login.php" method="POST">
                    <input type="text"  name="username" placeholder="nom" required />
                    <input type="password" name="password" placeholder="mot de passe" required />
                    <button class="opacity" type="submit">Se connecter</button>
                </form>
                <div class="register-forget opacity">
                    <a href="register.php">S'inscrire</a>
                    <a href="reset_password_form.php">Mot de passe oublié</a>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>
</html>
