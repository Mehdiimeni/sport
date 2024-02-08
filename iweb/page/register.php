<?php
//page / register

$objFileCaller = FileCaller::getInstance();
$objFileCaller->includeFileWithController('./iweb', 'user/', 'register');