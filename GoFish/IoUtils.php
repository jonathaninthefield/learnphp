<?php
namespace LearnPhp\GoFish;

/**
 * Utility functions for input/output operations.
 */
class IoUtils {
    /**
     * @var resource
     */
    public static $stdin;
    
    /**
     * Prompts the user for input, displaying $message.
     * @param string $message
     * @return string
     */
    public static function prompt($message) {
        static::out($message);
        if (!static::$stdin) {
            static::$stdin = fopen('php://stdin', 'r');
        }
        
        return trim(fgets(static::$stdin), "\r\n");
    }
    
    /**
     * Formats var_dump for the console.
     * @param mixed $var
     */
    public static function dump($var) {
        var_dump($var);
        echo "\n";
    }
    
    /**
     * Formats echo for the console.
     * @param mixed $var
     */
    public static function out($var) {
        echo $var . "\n";
    }
    
    /**
     * Used to end a console script.
     */
    public static function finish() {
        echo "\n\n";
    }
}