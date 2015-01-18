<?php
namespace LearnPhp\GoFish\Lib;

/**
 * Reads input from a file and outputs to another file.
 * 
 * The default mode reads line-by-line for the next input.
 */
class FilePrompter implements Prompter {
    /**
     * File to read input from.
     * @var \SplFileObject
     */
    protected $inFile;
    
    /**
     * File to write output to.
     * @var \SplFileObject
     */
    protected $outFile;
    
    public function __construct(\SplFileObject $inFile, \SplFileObject $outFile) {
        $this->inFile = $inFile;
        $this->outFile = $outFile;
    }
    
    /**
     * Reads the next line from the file.
     * @return string
     */
    protected function read() {
        return trim($this->inFile->fgets());
    }
    
    /**
     * Writes the output to the next line of the file.
     * @param string $output
     * @return \LearnPhp\GoFish\Lib\FilePrompter
     */
    protected function write($output) {
        $this->outFile->fwrite($output . "\n");
        return $this;
    }
    
    /**
     * Prompts for input with message $str.
     * @param string $str
     * @return string
     */
    public function prompt($str) {
        $this->write($str);
        return $this->read();
    }
    
    /**
     * Sends $str message.
     * @param string $str
     * @param bool $isError
     * @return Prompter
     */
    public function message($str, $isError = false) {
        $prefix = !$isError ? '' : '[ERROR:] ';
        $this->write($prefix . $str);
        return $this;
    }
}