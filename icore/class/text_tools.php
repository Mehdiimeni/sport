<?php
class TextTools
{
    private $routes = [];
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    function truncateText($text, $length = 150, $ellipsis = '...') {
        if (strlen($text) <= $length) {
            return $text;
        }
    
        $truncateText = substr($text, 0, $length);
        $lastSpace = strrpos($truncateText, ' ');
    
        if ($lastSpace !== false) {
            $truncateText = substr($truncateText, 0, $lastSpace);
        }
    
        return $truncateText . $ellipsis;
    }

  
}


?>