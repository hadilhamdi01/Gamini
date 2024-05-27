<?php
// Démarre la session
session_start();

// Détruit toutes les données de session
session_destroy();

// Redirige vers la page de connexion
header("Location: login.php");
exit();