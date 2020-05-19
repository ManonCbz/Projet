<?php

require 'header.php';

// ===== verification de connexion ===== //

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}



require '../view/searchView.php';
require 'footer.php';