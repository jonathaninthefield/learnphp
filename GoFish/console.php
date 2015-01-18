<?php
require('include.php');
use LearnPhp\GoFish\PlayGameCommand;
use LearnPhp\GoFish\Lib\ConsoleIo;
use LearnPhp\GoFish\Lib\FilePrompter;

//$console = new ConsoleIo();
$io = new FilePrompter(
    new \SplFileObject('fixtures/input.txt'),
    new \SplFileObject('fixtures/output.txt', 'w+')
);
try {
    $command = new PlayGameCommand($io);
    $command->run();
} catch (\Exception $ex) {
    $io->message($ex->getMessage(), true);
    $io->message($ex->getTraceAsString(), true);
}
