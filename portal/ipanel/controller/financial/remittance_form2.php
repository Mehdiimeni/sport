<?php
///controller/financial/remittance_form2.php
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
    'remittance_form2',
    $_SESSION['admin_id'],
    $_SESSION['rbac_id'],
    'a',
    'cheque',
    $isEntry,
    $_SESSION["role"],
);