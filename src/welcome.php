<?php
// Démarrer la session pour accéder aux données de session
session_start();

// Afficher le nom d'utilisateur de l'utilisateur connecté
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <p>This is the welcome page. You are logged in.</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
