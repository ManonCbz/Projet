<?php

require 'header.php';

if (!empty($_SESSION['username'])) {
    header('Location: profile.php');
}

$usernamePlaceholder = "Pseudo";
$passwordPlaceholder = "Mot de passe";

if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {

    $user = getLog($_POST['username']);

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['username'] = $_POST['username'];

        getID($_SESSION['username']);
        header('Location: profile.php');
    } else {
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