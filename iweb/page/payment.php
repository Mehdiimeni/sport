<?php
//page / payment

$objFileCaller = FileCaller::getInstance();
$objFileCaller->includeFileWithController('./iweb', 'user/', 'payment');