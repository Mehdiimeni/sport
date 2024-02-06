<?php
///controller/financial/remittance_form1.php
$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);
$allRemittance = $financial->getRemittanceForm1();
