<?php
///controller/global/menu.php

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$rbac = new RBAC($db);
