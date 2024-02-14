<?php 
namespace Config;
// In /config/function.php

/**
 * Clase Functions que provee métodos estáticos de utilidad para la aplicación.
 *
 * Incluye funcionalidades para depurar y registrar errores en un archivo de log.
 */
class Functions {
    /**
     * Imprime el contenido de una variable de manera legible para el desarrollador y termina la ejecución del script.
     *
     * @param mixed $content El contenido a depurar. Puede ser de cualquier tipo.
     */
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

    /**
     * Registra un mensaje de error en un archivo de log.
     *
     * @param string $error El mensaje de error a registrar.
     */
    public static function logError($error) {
        // Ruta al archivo de log (ajusta esto según tu estructura de directorios)
        $logFile = './logfile.log';
    
        // Mensaje a registrar
        $message = '[' . date('Y-m-d H:i:s') . '] Error: ' . $error . PHP_EOL;
    
        // Escribir en el archivo de log
        file_put_contents($logFile, $message, FILE_APPEND);
    }
    
}


?>