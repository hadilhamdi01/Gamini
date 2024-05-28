<!-- details.php -->
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

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Échapper les données de l'ID de l'événement pour éviter les attaques par injection SQL
$id_ev = isset($_GET['id_ev']) ? $conn->real_escape_string($_GET['id_ev']) : '';

$sql = $id_ev ? "SELECT * FROM events WHERE id_ev = '$id_ev'" : '';
$result = $id_ev ? $conn->query($sql) : null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la compétition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f6f6f6;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
            margin-bottom: 30px;
            padding: 20px;
        }
        .card-header {
            background-color: rgba(0,0,0,.03);
            border-bottom: 1px solid rgba(0,0,0,.125);
            padding: .75rem 1.25rem;
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Détails de la compétition</h4>
        </div>
        <div class="card-body">
            <?php
            if ($id_ev) {
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<p><strong>Nom :</strong> " . htmlspecialchars($row['nom']) . "</p>";
                    echo "<p><strong>Date :</strong> " . htmlspecialchars($row['date']) . "</p>";
                    echo "<p><strong>Description :</strong> " . htmlspecialchars($row['description']) . "</p>";
                    echo "<p><strong>Prix :</strong> " . htmlspecialchars($row['prix']) . "</p>";
                } else {
                    echo "<p>Aucun détail trouvé pour cet événement.</p>";
                }
            } else {
                echo "<p>Aucun ID d'événement spécifié.</p>";
            }
            ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
