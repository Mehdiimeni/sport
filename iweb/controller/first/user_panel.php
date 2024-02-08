<?php
///controller/first/user_panel.php

$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);


if (!$user->loggedIn()) {
    echo "<script>window.location.replace('./login');</script>";
    exit();
}

if (!$user->card_register()) {
    echo "<script>window.location.replace('./card_register');</script>";
    exit();
}


?>