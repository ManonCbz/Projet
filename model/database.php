<?php

$conn = new Mysqli ("localhost", "root", "");

if ($conn->connect_error) {
    echo $conn->connect_error;
} else {
    $conn->select_db("project-spot");
}


// =========================================== Fonctions =========================================== //


function createAccount($username, $email, $password)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();
    $stmt->close();
}


function createInformation($username)
{
    global $conn;

    $sql = 'SELECT id FROM users WHERE username = \'' . $username . '\'';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $stmt = $conn->prepare('INSERT INTO user_information (id_user) VALUES (?)');
    $stmt->bind_param("i", $row['id']);
    $stmt->execute();
}

// ===========================================  Get  =========================================== //


function getID($username)
{
    global $conn;

    $sql = 'SELECT id FROM users WHERE username = \'' . $username . '\'';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['userID'] = $row['id'];
}

function getInformations($id)
{

    global $conn;

    $sql = 'SELECT * FROM `user_information` WHERE id_user = \'' . $id . '\'';
    $result = $conn->query($sql);
    $row1 = $result->fetch_assoc();

    return array("presentationText" => $row1['presentation'], "websiteValue" => $row1['website']);
}

// ===========================================  Update  =========================================== //

function updateInformations($presentation, $website, $id)
{
    global $conn;

    $stmt = $conn->prepare('UPDATE `user_information` SET `presentation` = ?, `website` = ? WHERE `user_information`.`id_user` = ?');
    $stmt->bind_param("ssi", $presentation, $website, $id);
    $stmt->execute();
    $stmt->close();
}

function updateEmail($newEmail, $id)
{

    global $conn;

    $stmt = $conn->prepare('UPDATE users SET email = ? WHERE id = ?');
    $stmt->bind_param("si", $newEmail, $id);
    $stmt->execute();
    $stmt->close();
}

// ===========================================  Pictures  =========================================== //

function addPicture($id, $img_name)
{

    global $conn;
    $img_name = date("YmdHis") . $_FILES['image']['name'];

    $stmt = $conn->prepare('INSERT INTO images (id_user, img_name) VALUES (?, ?)');
    $stmt->bind_param("is", $id, $img_name);
    $stmt->execute();
    $stmt->close();

    move_uploaded_file($_FILES['image']['tmp_name'], '../view/upload/' . date("YmdHis") . $_FILES['image']['name']);
}


function displayPicture($id)
{

    global $conn;

    $sql = $conn->query("SELECT * FROM images WHERE id_user = " . $id);

    $i = 0;

    while ($row = $sql->fetch_assoc()) {
        $images[$i] = $row['img_name'];
        $i++;
        echo "<img class='imgDiv' src='../view/upload/" . $row['img_name'] . "'>";
    }

    //return $images;

}