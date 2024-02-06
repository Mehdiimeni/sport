<?php
///controller/financial/remittance.php
$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);
$allRemittance = $financial->getRemittance();
