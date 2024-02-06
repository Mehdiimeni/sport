<?php
//index.php 

require __DIR__ . "/vendor/autoload.php";
SessionTools::init();

strpos($_SERVER["HTTP_HOST"], "localhost") !== false ? error_reporting(E_ALL) : error_reporting(0);
require __DIR__ ."/iweb/core/route.php";
exit();

