<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['username'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $role = $_POST['role'];
    $titre = $_POST['titre'];
    $mdp = $_POST['password'];

     // Hasher le mot de passe
     $hashed_password = password_hash($mdp, PASSWORD_DEFAULT);

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

    // Requête SQL pour insérer un nouvel utilisateur
    $sql = "INSERT INTO users (username, email, ville, role, titre, password) VALUES ('$nom', '$email', '$ville', '$role', '$titre', ' $hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Rediriger vers une page de succès ou afficher un message de succès
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>






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

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<form action="add.php" method="post">
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
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Ajouter utilisateur</h3>
                            </a>
                            
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingText" placeholder="jhondoe" name="username">
                            <label for="floatingText">Nom d'utilisateur</label>
</div>
                     
                        <div class="form-floating mb-3">
                             <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                             <label for="floatingInput">Adresse email</label>
                        </div>
                        <div class="form-floating mb-3">
                             <input type="text" class="form-control" id="floatingText" placeholder="jhondoe" name="ville">
                             <label for="floatingText">Ville</label>
                        </div>

                        <div class="form-floating mb-3">
    <select class="form-select" id="role" name="role">
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
    <label for="role">Rôle</label>
</div>
<div class="form-floating mb-3">
    <select class="form-select" id="titre" name="titre">
        <option value="Développeur">Développeur</option>
        <option value="Joueur">Joueur</option>
    </select>
    <label for="titre">Titre</label>
</div>

                        <div class="form-floating mb-4">
                             <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                             <label for="floatingPassword">Mot de passe</label>
                        </div>
                       
                        
                        <div class="form-floating mb-4">
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Ajouter</button>

                        </div>
                        </div>
                       
                </div>
            </div>
        </div>
        <!-- Sign Up End -->

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