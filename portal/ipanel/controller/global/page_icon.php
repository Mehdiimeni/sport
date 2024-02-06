<?php
///controller/global/page_icon.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = Configuration::getInstance();
$adminLanguage = isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : $config->getConfig('defaltLanguageAdmin');
define('_lang', $config->getLang($adminLanguage));
$adminLanguageDir = in_array($adminLanguage, ['fa', 'ar']) ? 'rtl' : 'ltr';
setcookie('adminLanguageDir', $adminLanguageDir, time() + 7 * 24 * 60 * 60 * 1000, '/');
?>