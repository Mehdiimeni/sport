<?php
///controller/admin/login.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = Configuration::getInstance();
$adminLanguage = isset($_COOKIE['admin_language']) ? $_COOKIE['admin_language'] : $config->getConfig('defaltLanguageAdmin');
define('_lang', $config->getLang($adminLanguage));
$adminLanguageDir = in_array($adminLanguage, ['fa', 'ar']) ? 'rtl' : 'ltr';
setcookie('adminLanguageDir', $adminLanguageDir, time() + 7 * 24 * 60 * 60 * 1000, '/');

$allLanguages = $config->getConfig('allLanguage');

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$admin = new Admin($db);

if ($admin->loggedIn()) {
    echo "<script>window.location.replace('./index');</script>";
    exit;
}


$loginMessage = '';
if (!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $admin->email = $_POST["email"];
    $admin->password = $_POST["password"];
    if ($admin->login()) {
        echo "<script>window.location.replace('./index');</script>";
        exit;
    } else {
        $loginMessage = _lang['invalid_login'];
    }
} else if (!empty($_POST["login"])) {
    $loginMessage = _lang['field_null'];
}