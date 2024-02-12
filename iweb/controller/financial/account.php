<?php
///controller/financial/account.php
$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);
$allPayments = $financial->getPayments();