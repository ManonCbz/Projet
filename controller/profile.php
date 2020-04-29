<?php
require 'header.php';

if(empty($_SESSION['username'])){
    header('Location: login.php');
}

require '../vue/profileView.php';
require 'footer.php';