<?php
//page / index

$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$ticket = new Ticket($db);


$objFileCaller = FileCaller::getInstance();
$objFileCaller->includeFileWithController('./iweb', 'global/', 'page_top_web');
$objFileCaller->includeFileWithController('./iweb', 'global/', 'top_bar_web');
$objFileCaller->includeFileWithController('./iweb', 'global/', 'menu_web');
$objFileCaller->includeFileWithController('./iweb', 'first/', 'first');
$objFileCaller->includeFileWithController('./iweb', 'global/', 'page_footer_web');