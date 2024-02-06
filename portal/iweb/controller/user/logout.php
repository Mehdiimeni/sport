<?php
///controller/user/logout.php

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$user->user_log('logout');
$_SESSION["user_id"] = '';
session_destroy();
echo "<script>window.location.replace('./login');</script>";