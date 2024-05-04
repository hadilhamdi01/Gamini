<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Utilisateur</title>
</head>
<body>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <h6 class="mb-4">Modifier un Utilisateur</h6>
        <form action="modifier_traitement.php" method="post">
            <?php
            // Récupérer les données de l'utilisateur à modifier depuis la base de données
            // Assurez-vous de remplacer les valeurs de connexion avec les vôtres
            $servername = "localhost"; // Nom du serveur MySQL
            $username = "root"; // Nom d'utilisateur MySQL
            $password = ""; // Mot de passe MySQL
            $dbname = "gamini"; // Nom de la base de données

            // Créer une connexion
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("La connexion a échoué : " . $conn->connect_error);
            }

            // Récupérer l'ID de l'utilisateur à modifier depuis l'URL
            $id = $_GET["id"];

            // Requête SQL pour récupérer les données de l'utilisateur à modifier
            $sql = "SELECT * FROM users WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Afficher les données de l'utilisateur dans le formulaire
                $row = $result->fetch_assoc();
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>
                      <div class='mb-3'>
                          <label for='nom' class='form-label'>Nom</label>
                          <input type='text' class='form-control' id='nom' name='username' value='" . $row["username"] . "'>
                      </div>
                      <div class='mb-3'>
                          <label for='email' class='form-label'>Email</label>
                          <input type='email' class='form-control' id='email' name='email' value='" . $row["email"] . "'>
                      </div>
                      <div class='mb-3'>
                          <label for='ville' class='form-label'>Ville</label>
                          <input type='text' class='form-control' id='ville' name='ville' value='" . $row["ville"] . "'>
                      </div>
                      <div class='mb-3'>
                          <label for='role' class='form-label'>Role</label>
                          <input type='text' class='form-control' id='role' name='role' value='" . $row["role"] . "'>
                      </div>
                      <div class='mb-3'>
                          <label for='titre' class='form-label'>Titre</label>
                          <input type='text' class='form-control' id='titre' name='titre' value='" . $row["titre"] . "'>
                      </div>
                      <button type='submit' class='btn btn-primary'>Modifier</button>";
            } else {
                echo "Utilisateur non trouvé.";
            }
            $conn->close();
            ?>
        </form>
    </div>
</div>

</body>
</html>
