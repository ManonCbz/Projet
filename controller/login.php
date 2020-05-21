<?php

require 'header.php';

// ===== verification de connexion (Si la session est déjà ouverte -> profile.php) ===== //

if (!empty($_SESSION['username'])) {
    header('Location: profile.php');
}
if(!empty($_SESSION['admin'])){
    header('Location: admin.php');
}


$usernamePlaceholder = "Pseudo";
$passwordPlaceholder = "Mot de passe";

if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {

    $user = getLog($_POST['username']);

    if ($user && password_verify($_POST['password'], $user['password'])) {


        if($user['type'] == 0){
            $_SESSION['username'] = $_POST['username'];

            getID($_SESSION['username']);
            header('Location: profile.php');
        }

        if($user['type'] == 1){
            $_SESSION['admin'] = $_POST['username'];

            header('Location: admin.php');
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