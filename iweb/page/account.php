<?php
//page / account

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
$objFileCaller->includeFileWithController('./iweb', 'global/', 'page_top');
$objFileCaller->includeFileWithController('./iweb', 'global/', 'top_bar');
$objFileCaller->includeFileWithController('./iweb', 'global/', 'horizontal_menu');
$objFileCaller->includeFileWithController('./iweb', 'financial/', 'account');
$objFileCaller->includeFileWithController('./iweb', 'global/', 'page_footer');