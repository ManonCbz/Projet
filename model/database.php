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

// ===========================================  Display  =========================================== //

function addPicture($id, $latitude, $longitude)
{
    global $conn;
    $img_name = date("YmdHis") . $_FILES['image']['name'];

    $stmt = $conn->prepare('INSERT INTO images (id_user, img_name, latitude, longitude) VALUES (?, ?, ?, ?)');
    $stmt->bind_param("isdd", $id, $img_name, $latitude, $longitude);
    $stmt->execute();
    $stmt->close();

    $sql = $conn->query("SELECT * FROM images WHERE img_name = '$img_name'");
    $row = $sql->fetch_assoc();


    $stmt2 = $conn->prepare('INSERT INTO image_information (id_user, id_image) VALUES (?, ?)');
    $stmt2->bind_param("ii", $id, $row['id']);
    $stmt2->execute();
    $stmt2->close();

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

    $sql = $conn->query('SELECT * FROM images WHERE status = 0 ORDER BY id LIMIT 1');
    $row = $sql->fetch_assoc();

    $_SESSION['imageID'] = $row['id'];

    if (isset($row['id'])) {
        ?>
        <style>
            #controle p {
                display: none;
            }

            .imgDivAdmin {
                display: block;
            }

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

    $latMin = $lat - 0.02;
    $latMax = $lat + 0.02;
    $lngMin = $lng - 0.1;
    $lngMax = $lng + 0.1;

    $sql = $conn->query("SELECT * FROM `images` WHERE `latitude` BETWEEN $latMin AND $latMax AND `longitude` BETWEEN $lngMin AND $lngMax");

    $tableau = array();

    while ($row = $sql->fetch_assoc()) {
        echo "<div><img class='imgDiv' src='../view/upload/" . $row['img_name'] . "'><br> Lat / Lng :" . $row['latitude'] . $row['longitude'] . "</div>";
        $tableau[] = $row['img_name']. $row['latitude']. $row['longitude'];
    }

    // On a notre $tableau au-dessus, on va l'afficher, traduit en JSON
    echo json_encode($tableau);
}
