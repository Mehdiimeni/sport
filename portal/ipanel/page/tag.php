<?php
//page / index

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$admin = new Admin($db);
$ticket = new Ticket($db);


if (!$admin->loggedIn()) {
    echo "<script>window.location.replace('./login');</script>";
    exit();
}

$objFileCaller = FileCaller::getInstance();
$objFileCaller->includeFileWithController('.', 'global/', 'page_icon');
$objFileCaller->includeFileWithController('.', 'global/', 'page_css_table');
$objFileCaller->includeFileWithController('.', 'global/', 'page_top');
$objFileCaller->includeFileWithController('.', 'global/', 'menu');
$objFileCaller->includeFileWithController('.', 'structure/', 'tag');
$objFileCaller->includeFileWithController('.', 'global/', 'page_footer');
$objFileCaller->includeFileWithController('.', 'global/', 'page_js_table');