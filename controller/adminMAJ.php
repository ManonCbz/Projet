<?php

require 'header.php';

// ===== verification de connexion admin ===== //

if (empty($_SESSION['admin'])) {
    ?>
    <script> document.location.replace("login.php"); </script>
    <?php
}


require '../view/adminMAJView.php';
require '../controller/footer.php';