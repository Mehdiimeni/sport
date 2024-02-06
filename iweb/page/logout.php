<?php
//page / login

$objFileCaller = FileCaller::getInstance();
$objFileCaller->includeFileWithController('./iweb', 'user/', 'logout');