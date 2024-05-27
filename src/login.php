<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gamini";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password, role, titre FROM users WHERE username = ?");
    if (!$stmt) {
        die("Échec de la préparation de la requête : " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $loginStatus = "failure";
    $userId = null;

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["titre"] = $row["titre"];

            $userId = $row["id"];
            $loginStatus = "success";

            // Enregistrer l'historique de la connexion (succès)
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $loginTime = date('Y-m-d H:i:s');

            $historyStmt = $conn->prepare("INSERT INTO login_history (user_id, username, login_time, ip_address, user_agent, login_status) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$historyStmt) {
                die("Échec de la préparation de la requête d'historique : " . $conn->error);
            }
            $historyStmt->bind_param("isssss", $userId, $username, $loginTime, $ipAddress, $userAgent, $loginStatus);
            $historyStmt->execute();
            $historyStmt->close();

            if ($row["role"] == "admin") {
                header("Location: ../dash/index.php");
            } else if ($row["role"] == "user") {
                if ($row["titre"] == "developpeur") {
                    header("Location: ../eya+hadil/developpeur.html");
                } else if ($row["titre"] == "joueur") {
                    header("Location: ../eya+hadil/joueur.html");
                } else {
                    header("Location: ../eya+hadil/portfolio.html");
                }
            }
            exit();
        } else {
            echo "Mot de passe incorrect.<br>";
        }
    } else {
        echo "Utilisateur non trouvé.<br>";
    }

    // Enregistrer l'historique de la connexion (échec)
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $loginTime = date('Y-m-d H:i:s');

    $historyStmt = $conn->prepare("INSERT INTO login_history (user_id, username, login_time, ip_address, user_agent, login_status) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$historyStmt) {
        die("Échec de la préparation de la requête d'historique : " . $conn->error);
    }
    $historyStmt->bind_param("isssss", $userId, $username, $loginTime, $ipAddress, $userAgent, $loginStatus);
    $historyStmt->execute();
    $historyStmt->close();

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
                    <input type="text"  name="username" placeholder="nom" />
                    <input type="password" name="password" placeholder="mot de passe" />
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