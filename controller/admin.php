<?php

require 'header.php';

// ===== verification de connexion admin ===== //

if (empty($_SESSION['admin'])) {
    ?>
    <script language="Javascript">  document.location.replace("login.php"); </script>
    <?php
}


$picture = getAllImages();

// Validation de la photo :

if(isset($_POST['accept'])){
    validateImageAdmin($_SESSION['imageID']);
}

// Refus de la photo :

if(isset($_POST['delete'])){
    deleteImageAdmin($_SESSION['imageID']);
}

require '../view/adminView.php';
require '../controller/footer.php';