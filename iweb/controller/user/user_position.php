<?php
///controller/user/user_position.php
$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$allPosition = $user->getPosition();