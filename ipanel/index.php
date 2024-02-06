<?php
//index.php 

require "../vendor/autoload.php";
SessionTools::init();

strpos($_SERVER["HTTP_HOST"], "localhost") !== false ? error_reporting(E_ALL) : error_reporting(0);

//$locationManager = LocationManager::getInstance();
//require __DIR__ . "/lang/" . $locationManager->getLanguage() . "_panel.php";
require __DIR__ . "/core/route.php";
exit();