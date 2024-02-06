<?php
///controller/structure/operations.php
$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$structure = new Structure($db);
$text_tools = TextTools::getInstance();
$rbac = new RBAC($db);

$unique_fields = base64_encode(serialize(array("operation_name")));