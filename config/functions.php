<?php 
// In /config/function.php
class Functions {
    public static function debug($content) {
        echo '<pre>';
        if (is_bool($content) || is_null($content)) {
            var_dump($content);
        } else {
            print_r($content);
        }
        echo '</pre>';
        exit();
    }

    public static function getBaseUrl() {
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\')
        );
    }
    
}


?>