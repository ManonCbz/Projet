<?php

require 'header.php';

// ===== verification de connexion ===== //

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}
if (!empty($_SESSION['admin'])){
    header('Location: admin.php');
}



require '../view/searchView.php';
require 'footer.php';