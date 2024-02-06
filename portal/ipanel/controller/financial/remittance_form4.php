<?php
///controller/financial/remittance_form4.php
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

$allRemittance = $financial->getForwardsAdmin(
    'remittance_form4',
    $_SESSION['admin_id'],
    $_SESSION['rbac_id'],
    'a',
    'agent',
    $isEntry,
    $_SESSION["role"],
);