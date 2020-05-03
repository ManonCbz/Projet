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

    while($row = $result->fetch_assoc()){

        $_SESSION['userID'] = $row['id'];
        $stmt = $conn->prepare('INSERT INTO user_information (id_user) VALUES (?)');
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();
    }
}