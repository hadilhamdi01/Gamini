<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $date = $_POST['date'];
    $formatted_date = date('Y-m-d', strtotime($date));
    $titre = $_POST['titre'];



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
    $sql = "INSERT INTO events (date, nom,description,prix) VALUES ('$formatted_date', '$nom', '$description', '$prix')";

    if ($conn->query($sql) === TRUE) {
        // Rediriger vers une page de succès ou afficher un message de succès
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de la competition : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>
<style>
    .hidden-message {
        display: none;
    }
</style>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Gamini</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/hadil.jpg" alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Hamdi Hadil</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    
                </div>
                
                <a href="add.php" class="nav-item nav-link"><i class="fa fa-user-plus"></i> Ajouter Utlisateur</a>
                
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt=""
                                        style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/hadil.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Hamdi Hadil</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="..\src\logout.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Revenue</p>
                                <h6 class="mb-0">$1234</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Worldwide Sales</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="worldwide-sales"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Salse & Revenue</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="salse-revenue"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->


            <!-- Users -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Utilisateurs</h6>
                        <a href="add.php">Nouveau utilisateur</a>
                    </div>
                    <div class="table-responsive">
                        <?php
                        //  Connexion à la base de données
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "gamini";

                        // Créer une connexion
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Vérifier la connexion
                        if ($conn->connect_error) {
                            die("La connexion a échoué : " . $conn->connect_error);
                        }

                        //  Exécuter une requête SQL pour extraire les données
                        $sql = "SELECT * FROM users";

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {

                            echo '    <table class="table text-start align-middle table-bordered table-hover mb-0">';
                            echo '   <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>';
                            echo ' <tbody>';
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td><input class='form-check-input' type='checkbox'></td>
                                    <td>" . $row["id"] . "</td>
                                    <td>" . $row["username"] . "</td>
                                    <td>" . $row["email"] . "</td>
                                    <td>" . $row["ville"] . "</td>
                                    <td>" . $row["role"] . "</td>
                                    <td>" . $row["titre"] . "</td>
                                    <td>
                                    <a class='btn btn-sm btn-primary' href='modifier.php?id=" . $row["id"] . "'>
                                    <i class='fas fa-info-circle'></i>
                                </a>
                                <a class='btn btn-sm btn-danger' href='supprimer_utilisateur.php?id=" . $row["id"] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\")'>
                                <i class='fas fa-trash-alt'></i>
                            </a>
                                                                </td>
                                  </tr>";
                            }
                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo "0 résultats";
                        }
                        // Fermer la connexion à la base de données
                        $conn->close();
                        ?>

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->










            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="  col-md-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Messages</h6>
                                <a href="">Voir tout</a>
                            </div>
                            <?php
                            // Connexion à la base de données
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "gamini";

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Échec de la connexion : " . $conn->connect_error);
                            }

                            // Récupérer les demandes d'inscription en attente
                            $sql = "SELECT * FROM registration_requests WHERE status = 'pending'";
                            $result = $conn->query($sql);

                            // Afficher les demandes d'inscription
                            if ($result->num_rows > 0) {
                                $count = 0;
                               
                              
                                while ($row = $result->fetch_assoc()) {
                                    $count++;
                                    $hiddenClass = $count > 4 ? 'hidden-message' : '';

                                     // Calculer la différence de temps en minutes et heures
                        $requestDate = new DateTime($row["date"]);
                        $currentDate = new DateTime();
                        $interval = $currentDate->diff($requestDate);

                        $minutes = $interval->days * 24 * 60;
                        $minutes += $interval->h * 60;
                        $minutes += $interval->i;

                        if ($minutes < 60) {
                            $timeAgo = $minutes . ' minutes ago';
                        } else {
                            $hours = floor($minutes / 60);
                            $timeAgo = $hours . ' hours ago';
                        }

                                    echo '
                   
                           
                           
                                    <div class="d-flex align-items-center pt-3 ' . $hiddenClass . ' message-item" data-id="' . $row["id"] . '">
                            
                                <img class="rounded-circle flex-shrink-0" src="img/user1.png" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-0">' . $row["username"] . '</h6>
                                    <small>' . $timeAgo . '</small>
                                       
                                    </div>
                                 
                                </div>
                            </div>
                            ';
                                }
                            } else {
                                echo "Aucune demande d'inscription en attente.";
                            }

                            // Fermer la connexion à la base de données
                            $conn->close();
                            ?>
                        </div>
                    </div>


                    <div class="  col-md-4 ">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calendrier</h6>

                            </div>
                            <div id="calender"></div>

                            <div class="bootstrap-datetimepicker-widget usetwentyfour">
                                <!-- Ajoutez votre structure de calendrier ici -->
                            </div>
                        </div>
                    </div>


                    <div class=" col-md-4 ">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Compétitions</h6>
                                <a href="#" id="showAll">Voir tout</a>
                            </div>
<<<<<<<<< Temporary merge branch 1

=========
>>>>>>>>> Temporary merge branch 2
                            <ul class="list-group list-group-flush" id="competitionList">
                                <?php
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

                                // Requête SQL pour sélectionner tous les événements de la table "events" par ordre alphabétique du nom
                                $sql = "SELECT * FROM events ORDER BY nom";
                                $result = $conn->query($sql);

                                // Vérifier si des résultats ont été trouvés
                                if ($result && $result->num_rows > 0) {
                                    // Afficher les données dans un format de liste
                                    $counter = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $counter++;
                                        if ($counter <= 6) {
                                            echo "<li class='list-group-item d-flex justify-content-between align-items-center'><a href='detail.php?id_ev={$row['id_ev']}'>" . $row["nom"] . "</a><span class='badge bg-primary rounded-pill'>" . $row["date"] . "</span></li>";
                                        } else {
                                            echo "<li class='list-group-item d-flex justify-content-between align-items-center d-none'><a href='detail.php?id_ev={$row['id_ev']}'>" . $row["nom"] . "</a><span class='badge bg-primary rounded-pill'>" . $row["date"] . "</span></li>";
                                        }
                                    }
                                } else {
                                    echo "<li class='list-group-item'>Aucun résultat trouvé</li>";
                                }

                                // Fermer la connexion à la base de données
                                $conn->close();
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Widgets End -->


    <!-- Footer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                    <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulaire de date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
                        <div class="mb-3">
                            <label for="dateInput" class="form-label">Date sélectionnée :</label>
                            <input type="text" class="form-control" id="dateInput" readonly name="date">
                        </div>
                        <div class="mb-3">
                            <label for="dateInput" class="form-label">Théme</label>
                            <input type="text" class="form-control" id="dateInput" name="nom">
                        </div>
                        <div class="mb-3">
                            <label for="textInput" class="form-label">Description</label>
                            <input type="text" class="form-control" id="textInput" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="dateInput" class="form-label">Prix</label>
                            <input type="text" class="form-control" name="prix">
                        </div>
                        <!-- Ajoutez ici les champs de votre formulaire -->
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </form>
                </div>


                <!-- JavaScript Libraries -->
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Sélectionnez tous les éléments <td> qui ont l'attribut data-action="selectDay"
                        var days = document.querySelectorAll("td[data-action='selectDay']");

                        // Parcours de tous les éléments <td> et ajout d'un écouteur d'événements clic
                        days.forEach(function (day) {
                            day.addEventListener("click", function () {
                                // Récupérez la date à partir de l'attribut data-day
                                var selectedDate = day.getAttribute("data-day");

                                // Ouvrir le modal lorsque vous cliquez sur un élément <td>
                                var myModal = new bootstrap.Modal(document.getElementById(
                                    'exampleModal'));
                                myModal.show();

                                // Mettre à jour le champ de date du formulaire avec la date sélectionnée
                                document.getElementById('dateInput').value = selectedDate;
                            });
                        });
                    });
                </script>



                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        // Récupérer tous les éléments de liste
                        var competitions = document.querySelectorAll("#competitionList li");

                        // Cacher tous les éléments après le 6ème
                        for (var i = 6; i < competitions.length; i++) {
                            competitions[i].classList.add("d-none");
                        }

                        // Ajouter un gestionnaire d'événements pour le lien "Voir tout"
                        document.getElementById("showAll").addEventListener("click", function (e) {
                            e.preventDefault();
                            // Afficher tous les éléments cachés
                            for (var i = 6; i < competitions.length; i++) {
                                competitions[i].classList.remove("d-none");
                            }
                            // Cacher le lien "Voir tout" après avoir affiché toutes les compétitions
                            document.getElementById("showAll").style.display = "none";
                        });
                    });
                </script>
                <script>
                    function showAllMessages() {
                        const messages = document.querySelectorAll('.hidden-message');
                        messages.forEach(message => {
                            message.style.display = 'flex';
                        });
                    }
                </script>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const messages = document.querySelectorAll('.message-item');
                        messages.forEach(function (message) {
                            message.addEventListener('click', function () {
                                const id = message.getAttribute('data-id');
                                window.location.href = 'details_demande.php?id=' + id;
                            });
                        });
                    });
                </script>

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