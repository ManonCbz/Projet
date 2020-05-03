<?php
require '../controller/header.php';

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}


 $sql = 'SELECT * FROM `user_information` WHERE id_user = \'' . $_SESSION['userID'] . '\'';
 $result = $conn->query($sql);

 while ($row1 = $result->fetch_assoc()){
     $presentationText = $row1['presentation'];
     $websiteValue = $row1['website'];
 }

require '../view/profileView.php';
require 'footer.php';