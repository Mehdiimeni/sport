<?php
///controller/global/page_top.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$config = Configuration::getInstance();
$allLanguages = $config->getConfig('allLanguage');
?>