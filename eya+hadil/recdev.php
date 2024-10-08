<?php

// Démarrer la session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>bs4 past orders profile - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 20px;
            background: #000000;
        }

        /* My Account */

        .order-list .btn {
            border-radius: 2px;
            min-width: 121px;
            font-size: 13px;
            padding: 7px 0 7px 0;
        }

        .osahan-account-page-left .nav-link {
            padding: 18px 20px;
            border: none;
            font-weight: 600;
            color: #535665;
        }

        .osahan-account-page-left .nav-link i {
            width: 28px;
            height: 28px;
            background: #535665;
            display: inline-block;
            text-align: center;
            line-height: 29px;
            font-size: 15px;
            border-radius: 50px;
            margin: 0 7px 0 0px;
            color: #fff;
        }

        .osahan-account-page-left .nav-link.active {
            background: #0e0e0e;
            color: #3f3728 !important;
        }

        .osahan-account-page-left .nav-link.active i {
            background: #c811aa !important;
        }

        .osahan-user-media img {
            width: 90px;
        }

        .card offer-card h5.card-title {
            border: 2px dotted #000;
        }

        .card.offer-card h5 {
            border: 1px dotted #daceb7;
            display: inline-table;
            color: #e1ebed;
            margin: 0 0 19px 0;
            font-size: 15px;
            padding: 6px 10px 6px 6px;
            border-radius: 2px;
            background: #121211;
            position: relative;
        }

        .card.offer-card h5 img {
            height: 22px;
            object-fit: cover;
            width: 22px;
            margin: 0 8px 0 0;
            border-radius: 2px;
        }

        .card.offer-card h5:after {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid #daceb7;
            content: "";
            left: 30px;
            position: absolute;
            bottom: 0;
        }

        .card.offer-card h5:before {
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #daceb7;
            content: "";
            left: 30px;
            position: absolute;
            top: 0;
        }

        .payments-item .media {
            align-items: center;
        }

        .payments-item .media img {
            margin: 0 40px 0 11px !important;
        }

        .reviews-members .media .mr-3 {
            width: 56px;
            height: 56px;
            object-fit: cover;
        }

        .order-list img.mr-4 {
            width: 70px;
            height: 70px;
            object-fit: cover;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
            border-radius: 2px;
        }

        .osahan-cart-item p.text-gray.float-right {
            margin: 3px 0 0 0;
            font-size: 12px;
        }

        .osahan-cart-item .food-item {
            vertical-align: bottom;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #e9ecf1;
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }

        a:hover {
            text-decoration: none;
        }



        .custom-bg {
            background-color: #504f4f55;
            /* Remplacez cette couleur par celle de votre choix */
        }

        .customm-bg {
            background-color: #080808f0;
            /* Remplacez cette couleur par celle de votre choix */
        }

        .gold-members p {
            color: rgb(190, 190, 234);
            /* Remplacez "blue" par la couleur de votre choix */
        }

        .osahan-user-media-body p {
            color: white;
            /* Couleur blanche */
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(33, 32, 32, 0.821);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 5;
        }

        .popup {
            background-color: rgb(20, 20, 22);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            position: relative;
            text-align: center;
        }

        .popup input,
        .popup textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        .popup button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #218838;
        }

        .popup a.close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #333;
            text-decoration: none;
            font-size: 24px;
        }

        .popup a.close:hover {
            color: #000;
        }
    </style>
</head>

<body>
    <link rel="stylesheet" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css"
        integrity="sha384-jbCTJB16Q17718YM9U22iJkhuGbS0Gd2LjaWb4YJEZToOPmnKDjySVa323U+W7Fv" crossorigin="anonymous">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="osahan-account-page-left shadow-sm bg h-100 customm-bg">
                    <div class="border-bottom p-4">
                        <div class="osahan-user text-center">
                            <div class="osahan-user-media">
                                <img class="mb-3 rounded-pill shadow-sm mt-1" src="img/eya.jpg"
                                    alt="gurdeep singh osahan">
                                <div class="osahan-user-media-body">
                                    <h6 class="mb-2">Eya Zaafouri</h6>
                                    <p class="mb-1">6</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="btn btn-outline-success" href="addrecdev.php"><i
                                    class="icofont-headphone-alt"></i>Ajouter une
                                nouvelle réclamation</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="osahan-account-page-right shadow-sm bg p-4 h-100 customm-bg">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane  fade  active show" id="orders" role="tabpanel"
                            aria-labelledby="orders-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">Mes Réclamations</h4>
                            <div class="bg card mb-4 order-list shadow-sm custom-bg">
                                <div class="gold-members p-4">
                                    <a href="#">
                                    </a>

                                    <?php


                                    // Vérifier si l'utilisateur est connecté
                                    if (isset($_SESSION['user_id'])) {
                                        // L'utilisateur est connecté, récupérer son ID
                                        $user_id = $_SESSION['user_id'];

                                        // Établir une connexion à la base de données (à remplir avec vos propres informations)
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $database = "gamini";

                                        $conn = new mysqli($servername, $username, $password, $database);

                                        // Vérifier la connexion
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        // Requête SQL pour récupérer les réclamations de l'utilisateur connecté
                                        $sql = "SELECT * FROM reclam_dev WHERE utilisateur_id = $user_id";

                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // Affichage des réclamations
                                            echo "<ul>";
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <span class="float-right text-info">Deliverée le
                                                                <?php echo $row['date_reclamation']; ?><i
                                                                    class="icofont-check-circled text-success"></i></span>
                                                        </a>
                                                        <h6 class="mb-2">
                                                            <a href="#" class="text-black"><?php echo $row['sujet']; ?></a>
                                                        </h6>

                                                        <p class="text-gray mb-1"><i class="icofont-location-arrow"></i>
                                                            <?php echo $row['description']; ?>
                                                        </p>

                                                        <hr>
                                                        <div class="float-right">
                                                          
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo "Aucune réclamation trouvée pour cet utilisateur.";
                                        }
                                        // Fermer la connexion à la base de données
                                        $conn->close();
                                    } else {
                                        // L'utilisateur n'est pas connecté, rediriger vers la page de connexion par exemple
                                        header("Location: login.php");
                                        exit();
                                    }


                                    ?>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
            <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
            <script type="text/javascript">
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    var openPopupButton = document.getElementById("openPopup");
                    var popup = document.getElementById("popup");
                    var closePopupButton = document.getElementById("closePopup");

                    openPopupButton.addEventListener("click", function () {
                        popup.style.display = "flex";
                    });

                    closePopupButton.addEventListener("click", function () {
                        popup.style.display = "none";
                    });

                    var addReviewButton = document.getElementById("addReview");
                    var titleInput = document.getElementById("title");
                    var descriptionInput = document.getElementById("description");

                    addReviewButton.addEventListener("click", function () {
                        var title = titleInput.value;
                        var description = descriptionInput.value;

                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "traitement_reclamation.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                alert(xhr.responseText);
                                titleInput.value = "";
                                descriptionInput.value = "";
                                popup.style.display = "none";
                            }
                        };
                        xhr.send("title=" + encodeURIComponent(title) + "&description=" + encodeURIComponent(description));
                    });
                });
            </script>
</body>

</html>