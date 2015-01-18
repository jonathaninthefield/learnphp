<?php
namespace LearnPhp\GoFish\Lib;

/**
 * Reads/writes to the console.
 */
class ConsoleIo {
    /**
     * Provides an instance for a global scope.
     * @var ConsoleIo
     */
    protected static $singleton;
    
    public function instance() {
        if (static::$singleton) {
            return static::$singleton;
        }
        return static::$singleton = new static();
    }
    
    /**
     * Reads a trimmed string from the console.
     * @return string
     */
    public function read() {
        return trim(fgets(\STDIN));
    }
    
    /**
     * Prompts the user for input with $message.
     * @param string $message
     * @param null|callable $transformer Callback to transform; null to omit.
     * @return string The trimmed string input
     */
    public function prompt($message, callable $transformer = null) {
        $this->write($message);
        $value = $this->read();
        if (!$transformer) {
            return $value;
        } 
        
        while (!($newValue = call_user_func($transformer, $value))) {
            $this->writeln("That is an invalid value... $message");
            $value = $this->read();
        }
        return $newValue;
    }
    
    /**
     * Echoes $str to the console.
     * @param string $str
     * @return ConsoleIo
     */
    public function write($str) {
        fwrite(\STDOUT, $str);
        return $this;
    }
    
    /**
     * Writes $str with a newline.
     * @param string $str
     * @return ConsoleIo
     */
    public function writeln($str) {
        $this->write($str . "\n");
        return $this;
    }
}