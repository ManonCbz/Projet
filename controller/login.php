<?php

require 'header.php';

// ===== verification de connexion (Si la session est déjà ouverte -> profile.php) ===== //

if (!empty($_SESSION['username'])) {
    ?>
    <script> document.location.replace("profile.php"); </script>
    <?php
}
if(!empty($_SESSION['admin'])){
    ?>
    <script> document.location.replace("admin.php"); </script>
    <?php
}

$usernamePlaceholder = "Pseudo";
$passwordPlaceholder = "Mot de passe";


if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {

    // Recupere informations de connexion
    $user = getLog($_POST['username']);

    if ($user && password_verify($_POST['password'], $user['password'])) {

        // Utilisateur
        if($user['type'] == 0){
            $_SESSION['username'] = $_POST['username'];

            // Récupere et crée variable de session id
            getID($_SESSION['username']);

            ?>
            <script> document.location.replace("profile.php"); </script>
            <?php
        }

        // Administrateur
        if($user['type'] == 1){
            $_SESSION['admin'] = $_POST['username'];

            ?>
            <script> document.location.replace("admin.php"); </script>
            <?php
        }

    }

    else {
        ?>
        <style>
            .error {
                display: block;
            }
        </style>
        <?php
    }
}

require '../view/loginView.php';