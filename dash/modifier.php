<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gamini</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <form action="modifier_traitement.php" method="post">
        <div class="container-fluid position-relative d-flex p-0">
            <!-- Spinner Start -->
            <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->
             <!-- Sign Up Start -->
             <div class="container-fluid">
                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Modifier utilisateur</h3>
                                </a>
                                
                            </div>
         
                <?php
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
                    ?>
                    <input type='hidden' name='id' value='<?= $row["id"] ?>'>
                
                    <div class='form-floating mb-3'>
                        <input type='text' class='form-control' id='floatingText' name='username' value='<?= $row["username"] ?>'>
                        <label for='floatingText'>Nom</label>
                    </div>
                    <div class='form-floating mb-3'>
                        <input type='email' class='form-control' id='floatingInput' name='email' value='<?= $row["email"] ?>'>
                        <label for='floatingInput'>Email</label>
                    </div>
                    <div class='form-floating mb-3'>
                        <input type='text' class='form-control' id='floatingInput' name='ville' value='<?= $row["ville"] ?>'>
                        <label for='floatingInput'>Ville</label>
                    </div>
                   
<?php
$role = $row["role"];
?>

<div class='form-floating mb-3'>
    <select class='form-select' id='role' name='role'>
        <option value='admin' <?= ($role == "admin") ? "selected" : "" ?>>Admin</option>
        <option value='user' <?= ($role == "user") ? "selected" : "" ?>>User</option>
        <!-- Ajoutez d'autres options si nécessaire -->
    </select>
    <label for='role'>Rôle</label>
</div>

                    <?php
                    $titre = $row["titre"];
                    ?>

                    <div class='form-floating mb-3'>
                        <select class='form-select' id='titre' name='titre'>
                            <option value='developpeur' <?= ($titre == "developpeur") ? "selected" : "" ?>>Développeur</option>
                            <option value='joueur' <?= ($titre == "joueur") ? "selected" : "" ?>>Joueur</option>
                            <!-- Ajoutez d'autres options si nécessaire -->
                        </select>
                        <label for='titre'>Titre</label>
                    </div>

                    <button type='submit' class='btn btn-primary'>Modifier</button>
                <?php } else {
                    echo "Utilisateur non trouvé.";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>
</form>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>
