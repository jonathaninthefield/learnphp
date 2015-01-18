<?php
require('include.php');
use LearnPhp\GoFish\PlayGameCommand;
use LearnPhp\GoFish\Lib\ConsoleIo;

$io = new ConsoleIo();
try {
    $command = new PlayGameCommand($io);
    $command->run();
} catch (\Exception $ex) {
    $io->writeln($ex->getMessage(), true);
    $io->writeln($ex->getTraceAsString(), true);
}
