<?php
//page / login

$objFileCaller = FileCaller::getInstance();
$objFileCaller->includeFileWithController('.', 'admin/', 'login');