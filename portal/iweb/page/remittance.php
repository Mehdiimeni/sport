<?php
//page / task

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);


if (!$user->loggedIn()) {
    echo "<script>window.location.replace('./login');</script>";
    exit();
}

$objFileCaller = FileCaller::getInstance();

if (isset($_GET['remittance_id']) && !empty($_GET['remittance_id'])) {
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_top');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'top_bar');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'horizontal_menu');
    $objFileCaller->includeFileWithController('./iweb', 'financial/', 'remittance_details');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_footer');
} elseif(isset($_GET['add']) && !empty($_GET['add'])) {
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_top');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'top_bar');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'horizontal_menu');
    $objFileCaller->includeFileWithController('./iweb', 'financial/', 'remittance_add');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_footer');
}else{
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_top_table');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'top_bar');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'horizontal_menu');
    $objFileCaller->includeFileWithController('./iweb', 'financial/', 'remittance');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_footer_table');
    
}

