<?php

require 'header.php';

// ===== verification de connexion admin ===== //

if (empty($_SESSION['admin'])) {
    ?>
    <script> document.location.replace("login.php"); </script>
    <?php
}

// Recupere & affiche les informations des photos publiées (adminView.php)
$picture = getAllImagesAdmin();


if(isset($_POST['accept'])){
    // Valide la photo
    validateImageAdmin($_SESSION['imageID']);
}


if(isset($_POST['delete'])){
    // Supprime la photo & infos
    deleteImageAdmin($_SESSION['imageID']);
}

require '../view/adminView.php';
require '../controller/footer.php';