<?php
require 'header.php';


if(!empty($_FILES)){

    $img_name = $_FILES['image']['name'];
    $userID = $_SESSION['userID'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    addPicture($userID, $img_name, $latitude, $longitude);

    header('Location: profile.php');
}



require '../view/addPictureView.php';
require 'footer.php';
