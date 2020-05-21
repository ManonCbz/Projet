<?php

// Connexion à la base de donnée //

$conn = new Mysqli ("localhost", "root", "");

if ($conn->connect_error) {
    echo $conn->connect_error;
} else {
    $conn->select_db("project-spot");
}

// =========================================== Function =========================================== //

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

function getLog($username)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $user;
}

function getInformations($id)
{
    global $conn;

    $sql = 'SELECT * FROM `user_information` WHERE id_user = \'' . $id . '\'';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    return array("presentationText" => $row['presentation'], "websiteValue" => $row['website']);
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

// ===========================================  Display  =========================================== //

function addPicture($id, $latitude, $longitude)
{
    global $conn;
    $img_name = date("YmdHis") . $_FILES['image']['name'];

    $stmt = $conn->prepare('INSERT INTO images (id_user, img_name, latitude, longitude) VALUES (?, ?, ?, ?)');
    $stmt->bind_param("isdd", $id, $img_name, $latitude, $longitude);
    $stmt->execute();
    $stmt->close();

    move_uploaded_file($_FILES['image']['tmp_name'], '../view/upload/' . $img_name);
}

function displayPicture($id)
{
    global $conn;

    $sql = $conn->query("SELECT * FROM images WHERE id_user = " . $id);

    while ($row = $sql->fetch_assoc()) {
        echo "<img class='imgDiv' src='../view/upload/" . $row['img_name'] . "'>";
    }
}

// ===========================================  Delete  =========================================== //

function deleteAccount($id)
{
    global $conn;

    $sql = $conn->prepare("DELETE FROM users WHERE id=" . $id);
    $sql->execute();
    $sql->close();
}

function deleteInformations($id)
{
    global $conn;

    $sql2 = $conn->prepare("DELETE FROM user_information WHERE id_user=" . $id);
    $sql2->execute();
    $sql2->close();
}

function deletePictures($id)
{
    global $conn;

    $sql3 = $conn->prepare("DELETE FROM images WHERE id_user=" . $id);
    $sql3->execute();
    $sql3->execute();
    $sql3->close();
}

// ===========================================  Admin  =========================================== //

function getAllImages()
{
    global $conn;

    $sql = $conn->query('SELECT * FROM images WHERE status = 0 LIMIT 1');
    $row = $sql->fetch_assoc();

    if (isset($row['id'])) {
        echo "<div class='informationAdmin'>
                <img class='imgDivAdmin' src='../view/upload/" . $row['img_name'] . "'>
                <div class='adminInformationImage'> Latitude : " . $row['latitude'] . "<br> Longitude : " . $row['longitude'] . "</div>
              </div>";

        $_SESSION['imageID'] = $row['id'];
    }

    else {
        ?>
        <style>
            #controle p {
                display: block;
            }
        </style>
        <?php
    }
}

function validateImageAdmin($idImage)
{
    global $conn;

    $stmt = $conn->prepare('UPDATE images SET status= 1 WHERE id = ?');
    $stmt->bind_param("i", $idImage);
    $stmt->execute();
    $stmt->close();
}

function deleteImageAdmin($idImage)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM images WHERE id = ?");
    $stmt->bind_param('i', $idImage);
    $stmt->execute();
    $stmt->close();
}

//

function addAdminAccount($email)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();

}


function searchImage($lat, $lng)
{
    global $conn;

    $latMin = $lat - 0.005;
    $latMax = $lat + 0.005;
    $lngMin = $lng - 0.005;
    $lngMax = $lng + 0.005;

    $sql = $conn->query("SELECT * FROM `images` WHERE `latitude` BETWEEN $latMin AND $latMax AND `longitude` BETWEEN $lngMin AND $lngMax");

    while ($row = $sql->fetch_assoc()) {
        echo "<div><img class='imgDiv' src='../view/upload/" . $row['img_name'] . "'><br> Lat / Lng :" . $row['latitude'] . $row['longitude'] . "</div>";
    }
}