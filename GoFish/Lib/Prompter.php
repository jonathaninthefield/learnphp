<?php
namespace LearnPhp\GoFish\Lib;

interface Prompter {
    /**
     * Prompts for input with message $str.
     * @param string $str
     * @return string
     */
    public function prompt($str);
    
    /**
     * Sends $str message.
     * @param string $str
     * @param boolean $isError
     * @return Prompter
     */
    public function message($str, $isError = false);
}