<?php
///controller/user/user_achievements.php
$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$admin = new Admin($db);
$user = new User($db);
$financial = new Financial($db);
$rbac = new RBAC($db);


$isEntry = 0;
if ($rbac->checkPermissionOperationByName('pointer'))
    $isEntry = 1;


$allAchievement = $financial->getForwardsAdmin(
    'user_achievement',
    $_SESSION['admin_id'],
    $_SESSION['rbac_id'],
    'a',
    'user_achievement',
    $isEntry,
    $_SESSION["role"],
);