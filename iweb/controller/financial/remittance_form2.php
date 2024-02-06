<?php
///controller/financial/remittance_form2.php
$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);
$allRemittance = $financial->getRemittanceForm2();