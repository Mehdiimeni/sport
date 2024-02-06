<?php

class Configuration
{
    private static $instance;
    private $db;
    private $config;
    private $route;

    private function __construct()
    {
        $this->db = include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'db.php';
        $this->config = include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'config.php';
        $this->route = include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'route.php';
    }


    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getDB(string $key, string $key2)
    {
        return $this->db[$key][$key2] ?? null;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getLang($lang)
    {
        $allowedLanguages = $this->config['allowedLanguage'];

        if (in_array($lang, $allowedLanguages)) {
            $filePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . $lang . '.php';
            return include $filePath;
        }

        return null;
    }


    public function getConfig(string $key, string $key2 = '')
    {
        return $key2 == '' ? ($this->config[$key] ?? null) : ($this->config[$key][$key2] ?? null);
    }


}

?>