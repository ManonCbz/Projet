<?php
require 'header.php';

$msg = '';
$statueAddPicture = '';

if(!empty($_POST)){

    $img_name = $_FILES['image']['name'];
    $userID = $_SESSION['userID'];

    addPicture($userID, $img_name);

    header('Location: profile.php');

}

require '../view/addPictureView.php';
require 'footer.php';