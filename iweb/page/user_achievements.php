<?php
//page / user_achievements

$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);

if (!$user->loggedIn()) {
    echo "<script>window.location.replace('./login');</script>";
    exit();
}

$objFileCaller = FileCaller::getInstance();


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_top');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'top_bar');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'horizontal_menu');
    $objFileCaller->includeFileWithController('./iweb', 'user/', 'user_achievements_details');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_footer');
} elseif(isset($_GET['add']) && !empty($_GET['add'])) {
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_top');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'top_bar');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'horizontal_menu');
    $objFileCaller->includeFileWithController('./iweb', 'user/', 'user_achievements_add');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_footer');
}else{
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_top_table');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'top_bar');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'horizontal_menu');
    $objFileCaller->includeFileWithController('./iweb', 'user/', 'user_achievements');
    $objFileCaller->includeFileWithController('./iweb', 'global/', 'page_footer_table');
    
}