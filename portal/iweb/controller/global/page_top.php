<?php
///controller/global/page_top.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = Configuration::getInstance();
$userLanguage = isset($_COOKIE['user_language']) ? $_COOKIE['user_language'] : $config->getConfig('defaltLanguage');
define('_lang', $config->getLang($userLanguage));
$userLanguageDir = in_array($userLanguage, ['fa', 'ar']) ? 'rtl' : 'ltr';
setcookie('userLanguageDir', $userLanguageDir, time() + 7 * 24 * 60 * 60 * 1000, '/');

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$rbac = new RBAC($db);


?>