<!-- details.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la compétition</title>
</head>
<body>
    <h1>Détails de la compétition</h1>
    <?php
    // Vérifier si l'ID de l'événement est passé en tant que paramètre GET
    if (isset($_GET['id_ev'])) {
        // Établir une connexion à la base de données
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
        $id_ev = $conn->real_escape_string($_GET['id_ev']);

        // Requête SQL pour récupérer les détails de l'événement à partir de son ID
        $sql = "SELECT * FROM events WHERE id_ev = '$id_ev'";
        $result = $conn->query($sql);

        // Vérifier si des résultats ont été trouvés
        if ($result && $result->num_rows > 0) {
            // Afficher les détails de l'événement
            $row = $result->fetch_assoc();
            echo "<p>Nom : " . $row['nom'] . "</p>";
            echo "<p>Date : " . $row['date'] . "</p>";
            echo "<p>Description : " . $row['description'] . "</p>";
            echo "<p>Prix : " . $row['prix'] . "</p>";
        } else {
            echo "<p>Aucun détail trouvé pour cet événement.</p>";
        }

        // Fermer la connexion à la base de données
        $conn->close();
    } else {
        echo "<p>Aucun ID d'événement spécifié.</p>";
    }
    ?>
</body>
</html>
