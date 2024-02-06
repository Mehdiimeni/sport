<?php

$router = Router::getInstance();

$requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$config = Configuration::getInstance();
$allowedHosts = $config->getConfig('allowedHosts');
$targetPath = '/voc/ipanel/';

$routes = $config->getRoute();


if (in_array($_SERVER['HTTP_HOST'], $allowedHosts) && strpos($requestUrl, $targetPath) !== false) {
    $prefix = '';
    $requestUrl = str_replace($targetPath, "/", $requestUrl);
} else {
    $prefix = '/ipanel';
}

foreach ($routes as $route) {
    $fullPath = $prefix . $route['path'];
    $router->addRoute($fullPath, $route['file']);
}

$router->handleRequest($requestUrl);


