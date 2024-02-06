<?php
///controller/member/admins.php
$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$admin = new Admin($db);
$structure = new Structure($db);
$text_tools = TextTools::getInstance();
$rbac = new RBAC($db);


$unique_fields = base64_encode(serialize(array("email","mobile","name")));