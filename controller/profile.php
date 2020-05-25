<?php
require '../controller/header.php';

// ===== verification de connexion ===== //

if (empty($_SESSION['username'])) {
    ?>
    <script> document.location.replace("login.php"); </script>
    <?php
}
if (!empty($_SESSION['admin'])){
    ?>
    <script> document.location.replace("admin.php"); </script>
    <?php
}

// Recupere & affiche les informations de l'utilisateur (profileView.php)

$informationsUser = getInformations($_SESSION['userID']);


require '../view/profileView.php';
require 'footer.php';

