<?php

require 'header.php';

$id = $_SESSION['userID'];

deleteAccount($id, $id, $id);

header('Location: login.php');