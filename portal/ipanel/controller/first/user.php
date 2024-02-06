<?php
///controller/first/user.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$admin = new Admin($db);

$financial = new Financial($db);
$rbac = new RBAC($db);


$text_tools = TextTools::getInstance();