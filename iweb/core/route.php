<?php


$router = Router::getInstance();
$config = Configuration::getInstance();

$routes = $config->getRoute();

foreach ($routes as $route) {
    $router->addRoute($route['path'], $route['file']);
}

$requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$allowedHosts = $config->getConfig('allowedHosts');
$allowedUrl = $config->getConfig('allowedUrl');
$clearUrl = $config->getConfig('clearUrl');


if (in_array($_SERVER['HTTP_HOST'], $allowedHosts) && strpos($requestUrl, $allowedUrl) !== false) {
    $requestUrl = str_replace($clearUrl, "/", $requestUrl);
}


$router->handleRequest($requestUrl, "./iweb");
