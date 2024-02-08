<?php
///controller/user/register.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = Configuration::getInstance();
$userLanguage = isset($_COOKIE['user_language']) ? $_COOKIE['user_language'] : $config->getConfig('defaltLanguage');
define('_lang', $config->getLang($userLanguage));
$userLanguageDir = in_array($userLanguage, ['fa', 'ar']) ? 'rtl' : 'ltr';
setcookie('userLanguageDir', $userLanguageDir, time() + 7 * 24 * 60 * 60 * 1000, '/');

$allLanguages = $config->getConfig('allLanguage');


$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);

if ($user->loggedIn()) {
    echo "<script>window.location.replace('./user_panel');</script>";
}


$registerMessage = '';
if (!empty($_POST["sign_up"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && !empty($_POST["password"]) && !empty($_POST["checkbox-signup"]) && !empty($_POST["mobile"])) {
    $user->email = $_POST["email"];
    $user->password = $_POST["password"];
    $user->name = $_POST["name"];
    $user->mobile = $_POST["mobile"];
    if ($user->register()) {
        if ($user->loggedIn()) {
            echo "<script>window.location.replace('./user_panel');</script>";
        } else {
            echo "<script>window.location.replace('./login');</script>";
        }
    } else {
        $registerMessage = _lang['invalid_register'];
    }
} else if (!empty($_POST["register"])) {
    $registerMessage = _lang['field_null'];
}