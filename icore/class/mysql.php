<?php

class Database 
{
    private static $instance;
    private $host;
    private $user;
    private $password;
    private $database;
    private $config;

    // Dependency Injection
    private function __construct(Configuration $config)
    {
        $this->config = $config; 
        $this->initializeConnection();
    }

    // Use getInstance for Singleton pattern
    public static function getInstance(Configuration $config)
    {
        if (!self::$instance) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    private function initializeConnection()
    {
        $allowedHosts = $this->config->getConfig('allowedHosts');
        $environment = in_array($_SERVER['HTTP_HOST'], $allowedHosts) ? 'localhost' : 'production';
    
        $this->host = $this->config->getDB($environment, 'host');
        $this->user = $this->config->getDB($environment, 'user');
        $this->password = $this->config->getDB($environment, 'password');
        $this->database = $this->config->getDB($environment, 'database');
    
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Error failed to connect to MySQL: " . $conn->connect_error);
        } else {
            $conn->set_charset("utf8");
            return $conn;
        }
    }
    

    public function getConnection()
    {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($conn->connect_error) {
            die("Error failed to connect to MySQL: " . $conn->connect_error);
        } else {
            return $conn;
        }
    }
}

?>