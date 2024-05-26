<?php
session_start();

// Vérifier si l'utilisateur est connecté et a le rôle d'admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamini";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer l'historique des connexions
$sql = "SELECT lh.login_time, lh.ip_address, lh.user_agent, lh.login_status, lh.username 
        FROM login_history lh 
        ORDER BY lh.login_time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Historique des Connexions</title>
</head>
<body>
    <section class="container">
        <div class="login-container">
            <h1 class="opacity">Historique des logins</h1>
            <table>
                <thead>
                    <tr>
                        <th>Date et heure</th>
                        <th>Adresse IP</th>
                        <th>Agent utilisateur</th>
                        <th>Nom d'utilisateur</th>
                        <th>État de connexion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["login_time"] . "</td>";
                            echo "<td>" . $row["ip_address"] . "</td>";
                            echo "<td>" . $row["user_agent"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . ($row["login_status"] == "success" ? "Réussi" : "Échoué") . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Aucun historique de connexion trouvé</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>

<?php
$conn->close();
?>
