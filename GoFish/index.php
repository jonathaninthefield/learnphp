<?php
require('include.php');
use LearnPhp\GoFish\Game;
use LearnPhp\GoFish\Player;

function dump($var) {
    var_dump($var);
    echo "\n";
}
function out($var) {
    echo $var . "\n";
}
function finish() {
    echo "\n\n";
}

$game = new Game();
$game->addPlayer(new Player('Lauren'));
$game->addPlayer(new Player('Chris'));
$game->addPlayer(new Player('Roxie'));

$game->start();

out("Players: ");
print_r($game->getPlayers());

//while ($player = $game->getNextTurn()) {
//    $prompt = $player . ", who would you like to ask for cards?\n"
//        . "(Players: " . $game->getPlayers() . ")\n";
//    $target = readline($prompt);
//    
//}

//echo $game->summarizeResults();


finish();