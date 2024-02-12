<?php
///controller/user/user_achievements.php
$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$allAchievement = $user->getAchievement();