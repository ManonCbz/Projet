<?php

$conn = new Mysqli ("localhost", "root", "");

if ($conn->connect_error) {
    echo $conn->connect_error;
} else {
    $conn->select_db("project-spot");
}


// =========================================== Fonctions =========================================== //


function createAccount($username, $email, $password){
    global $conn;

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();
    $stmt->close();
}


function createInformation($username){
    global $conn;

    $sql = 'SELECT id FROM users WHERE username = \'' . $username . '\'';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $stmt = $conn->prepare('INSERT INTO user_information (id_user) VALUES (?)');
    $stmt->bind_param("i", $row['id']);
    $stmt->execute();
}

function getID($username){
    global $conn;

    $sql = 'SELECT id FROM users WHERE username = \'' . $username . '\'';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['userID'] = $row['id'];
}

function getInformations($id){

    global $conn;

    $sql = 'SELECT * FROM `user_information` WHERE id_user = \'' . $id . '\'';
    $result = $conn->query($sql);
    $row1 = $result->fetch_assoc();

    return array ("presentationText"=>$row1['presentation'], "websiteValue"=>$row1['website']);
}

function updateInformations($presentation, $website, $id){
    global $conn;

    $stmt = $conn->prepare('UPDATE `user_information` SET `presentation` = ?, `website` = ? WHERE `user_information`.`id_user` = ?');
    $stmt->bind_param("ssi", $presentation, $website, $id);
    $stmt->execute();
}