<?php

require 'header.php';

// ===== verification de connexion admin ===== //

if (empty($_SESSION['admin'])) {
    header('Location: login.php');
}


require '../view/adminMAJView.php';
require '../controller/footer.php';