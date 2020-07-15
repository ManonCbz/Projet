<?php

// Connexion à la base de donnée //

$conn = new Mysqli ("localhost", "root", "");

if ($conn->connect_error) {
    echo $conn->connect_error;
} else {
    $conn->select_db("project-spot");
}

// =========================================== Function =========================================== //
// 1 - INSERT / CREATE
// 2 - GET & DISPLAY INFO
// 3 - UPDATE
// 4 - DELETE
// 5 - ADMIN
// 6 - JSON

// =========================================== INSERT / CREATE =========================================== //


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

function addPicture($id, $latitude, $longitude, $city, $countryside, $sea, $mountain, $day)
{
    global $conn;
    // Ajout de la date au nom de l'image
    $img_name = date("YmdHis") . $_FILES['image']['name'];

    // Envoi infos image DB
    $stmt = $conn->prepare('INSERT INTO images (id_user, img_name, latitude, longitude) VALUES (?, ?, ?, ?)');
    $stmt->bind_param("isdd", $id, $img_name, $latitude, $longitude);
    $stmt->execute();
    $stmt->close();

    //Recupere ID image
    $sql = $conn->query("SELECT * FROM images WHERE img_name = '$img_name'");
    $row = $sql->fetch_assoc();

    // Crée info image
    $stmt2 = $conn->prepare('INSERT INTO image_information (id_user, id_image, city, countryside, sea, mountain, day) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt2->bind_param("iiiiiis", $id, $row['id'], $city, $countryside, $sea, $mountain, $day);
    $stmt2->execute();
    $stmt2->close();

    // Déplace image telechargée
    move_uploaded_file($_FILES['image']['tmp_name'], '../view/upload/' . $img_name);
}

// ===========================================  GET & DISPLAY INFO =========================================== //

function getID($username)
{
    global $conn;

    $sql = 'SELECT id FROM users WHERE username = \'' . $username . '\'';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // Ajoute variable de session id
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

    // Pour log.php & setting.php (vérif mdp)
    return $user;
}

function getInformations($id)
{
    global $conn;

    $sql = 'SELECT * FROM `user_information` WHERE id_user = \'' . $id . '\'';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Pour profile.php & setting.php (renvoi les informations)
    return array("presentationText" => $row['presentation'], "websiteValue" => $row['website']);
}


function displayPicture($id)
{
    global $conn;

    $sql = $conn->query("SELECT * FROM images WHERE id_user = " . $id);

    while ($row = $sql->fetch_assoc()) {
        echo "<img class='imgDiv' src='../view/upload/" . $row['img_name'] . "'>";
    }
}

function displayImageSearchCat($day)
{
    global $conn;

    $sql = $conn->query("SELECT * FROM images LEFT JOIN users ON (users.id = images.id_user) LEFT JOIN user_information ON (user_information.id_user = users.id) LEFT JOIN image_information ON (image_information.id_image = images.id) WHERE day = '$day'");

    while ($row = $sql->fetch_assoc()) {
        echo "<div class='divImgSearch'><img class='imgDiv' src='../view/upload/" . $row['img_name'] . "'><br> Latitude : " . $row['latitude'] ."<br> Longitude : ". $row['longitude'] . "<br>" . $row['username'] . "<br><a class='instagramLink' target='_blank' href=\"https://www.instagram.com/". $row['website'] . "/\">Instagram</a></div>";
    }
}

// ===============================================  UPDATE  =============================================== //

function updateInformations($presentation, $website, $id)
{
    global $conn;

    $stmt = $conn->prepare('UPDATE `user_information` SET presentation = ?, website = ? WHERE user_information.id_user = ?');
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

// ================================================  DELETE  ================================================ //

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

// ================================================  ADMIN  ================================================ //

function getAllImagesAdmin()
{
    global $conn;

    $sql = $conn->query('SELECT * FROM images WHERE status = 0 ORDER BY id LIMIT 1');
    $row = $sql->fetch_assoc();

    $_SESSION['imageID'] = $row['id'];

    if (isset($row['id'])) {
        ?>
        <style>
            #controle p {
                /* Enleve le bloc "Toutes les photos sont mises à jour" */
                display: none;
            }
                /* Affiche le bloc qui contiendra la photo */
            .imgDivAdmin {
                display: block;
            }
                /* Affiche le bloc de description de la photo */
            .adminInformationImage {
                display: block;
            }
        </style>
        <?php
    }

    return array("imgName" => $row['img_name'], "latitude" => $row['latitude'], "longitude" => $row['longitude']);
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

    $conn->query("DELETE FROM images WHERE id = $idImage");
    $conn->query("DELETE FROM image_information WHERE id_image = $idImage");
}


// =================================================  JSON  ================================================= //

function allImageJSON(){
    global $conn;

    $sql = $conn->query("SELECT * FROM `images` LEFT JOIN users ON (users.id = images.id_user) LEFT JOIN user_information ON (user_information.id_user = users.id) LEFT JOIN image_information ON (image_information.id_image = images.id)");

    $general = array();
    $data = array();
    $array = array();

    while ($row = $sql->fetch_assoc()) {
        $data["name"] = $row['username'];
        $data["presentation"] = $row['presentation'];
        $data['website'] = $row['website'];
        $data['imagename'] = $row['img_name'];
        $data['latitude'] = $row['latitude'];
        $data['longitude'] = $row['longitude'];

        $general[] = $data;
    }
    $array['infos'] = $general;
    echo json_encode($array);
}