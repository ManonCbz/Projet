<?php

require '../controller/header.php';

if (empty($_SESSION['username'])) {
    header('Location: login.php');
}

$username = $_SESSION['username'];
$presentationText = "";
$websiteValue = "";

$sql = 'SELECT id FROM users WHERE username = \'' . $username . '\'';
$result = $conn->query($sql);


while ($row = $result->fetch_assoc()) {

    $_SESSION['userID'] = $row['id'];

    $sql = 'SELECT * FROM `user_information` WHERE id_user = \'' . $row['id'] . '\'';
    $result = $conn->query($sql);

    while ($row1 = $result->fetch_assoc()){
        $presentationText = $row1['presentation'];
        $websiteValue = $row1['website'];
    }
}

require '../view/settingView.php';
require '../controller/footer.php';