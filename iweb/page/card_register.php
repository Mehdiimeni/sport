<?php
//page / index

$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$ticket = new Ticket($db);


$objFileCaller = FileCaller::getInstance();
$objFileCaller->includeFileWithController('./iweb', 'global/', 'page_top');
$objFileCaller->includeFileWithController('./iweb', 'global/', 'top_bar');
$objFileCaller->includeFileWithController('./iweb', 'global/', 'horizontal_menu');
$objFileCaller->includeFileWithController('./iweb', 'first/', 'card_register');
$objFileCaller->includeFileWithController('./iweb', 'global/', 'page_footer');