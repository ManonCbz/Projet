<?php

require 'header.php';

// ===== verification de connexion (Si la session est déjà ouverte -> profile.php) ===== //

if (!empty($_SESSION['username'])) {
    ?>
    <script language="Javascript">  document.location.replace("profile.php"); </script>
    <?php
}
if(!empty($_SESSION['admin'])){
    ?>
    <script language="Javascript">  document.location.replace("admin.php"); </script>
    <?php
}


$usernamePlaceholder = "Pseudo";
$passwordPlaceholder = "Mot de passe";

if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {

    $user = getLog($_POST['username']);

    if ($user && password_verify($_POST['password'], $user['password'])) {


        if($user['type'] == 0){
            $_SESSION['username'] = $_POST['username'];

            getID($_SESSION['username']);

            ?>
            <script language="Javascript">  document.location.replace("profile.php"); </script>
            <?php
        }

        if($user['type'] == 1){
            $_SESSION['admin'] = $_POST['username'];

            ?>
            <script language="Javascript">  document.location.replace("admin.php"); </script>
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