<?php
//page / organization_banks

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$admin = new Admin($db);
$financial = new Financial($db);


if (!$admin->loggedIn()) {
    echo "<script>window.location.replace('./login');</script>";
    exit();
}

$objFileCaller = FileCaller::getInstance();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $objFileCaller->includeFileWithController('.', 'global/', 'page_icon');
    $objFileCaller->includeFileWithController('.', 'global/', 'page_css_table');
    $objFileCaller->includeFileWithController('.', 'global/', 'page_top');
    $objFileCaller->includeFileWithController('.', 'global/', 'menu');
    $objFileCaller->includeFileWithController('.', 'organization/', 'organization_banks_details');
    $objFileCaller->includeFileWithController('.', 'global/', 'page_footer');
    $objFileCaller->includeFileWithController('.', 'global/', 'page_js_table');
} else {
    $objFileCaller->includeFileWithController('.', 'global/', 'page_icon');
    $objFileCaller->includeFileWithController('.', 'global/', 'page_css_table');
    $objFileCaller->includeFileWithController('.', 'global/', 'page_top');
    $objFileCaller->includeFileWithController('.', 'global/', 'menu');
    $objFileCaller->includeFileWithController('.', 'organization/', 'organization_banks');
    $objFileCaller->includeFileWithController('.', 'global/', 'page_footer');
    $objFileCaller->includeFileWithController('.', 'global/', 'page_js_table');

}

