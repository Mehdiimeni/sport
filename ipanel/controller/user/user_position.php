<?php
///controller/user/user_position.php
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


$allPosition = $financial->getForwardsAdmin(
    'user_position',
    $_SESSION['admin_id'],
    $_SESSION['rbac_id'],
    'a',
    'user_position',
    $isEntry,
    $_SESSION["role"],
);