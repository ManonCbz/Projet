<?php
require 'header.php';


if(!empty($_FILES)){

    $img_name = $_FILES['image']['name'];
    $userID = $_SESSION['userID'];

    addPicture($userID, $img_name);

    header('Location: profile.php');
}



require '../view/addPictureView.php';
require 'footer.php';
