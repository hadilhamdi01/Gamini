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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Historique des Connexions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f6f6f6;
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .card {
        background-color: #fff;
        border-radius: 10px;
        border: none;
        position: relative;
        margin-bottom: 30px;
        box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
    }

    .card .card-header {
        background-color: rgba(0,0,0,.03);
        border-bottom: 1px solid rgba(0,0,0,.125);
        padding: .75rem 1.25rem;
        border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
    }

    .card .card-body {
        padding: 20px 25px;
    }

    .table-responsive {
        max-height: 400px;
        overflow-y: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #e9e9eb;
        color: #666;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    table td:first-child {
        width: 20%;
    }

    table td:last-child {
        text-align: center;
    }
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Historique des logins</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                                        echo "<td data-label='Date et heure'>" . $row["login_time"] . "</td>";
                                        echo "<td data-label='Adresse IP'>" . $row["ip_address"] . "</td>";
                                        echo "<td data-label='Agent utilisateur'>" . $row["user_agent"] . "</td>";
                                        echo "<td data-label='Nom d'utilisateur'>" . $row["username"] . "</td>";
                                        echo "<td data-label='État de connexion'>" . ($row["login_status"] == "success" ? "Réussi" : "Échoué") . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>Aucun historique de connexion trouvé</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
