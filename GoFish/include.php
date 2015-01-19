<?php
error_reporting(E_ALL|E_STRICT);
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");

define('ROOT', dirname(__DIR__));
require(ROOT . '/GoFish/Lib/Prompter.php');
require(ROOT . '/GoFish/Lib/FilePrompter.php');
require(ROOT . '/GoFish/Lib/ConsoleIo.php');

//register_shutdown_function(function() {
//    foreach (debug_backtrace() as $line) {
//        \LearnPhp\GoFish\Lib\ConsoleIo::instance()->writeln(
//            print_r($line, true)
//        );
//    }
//});

require(ROOT . '/GoFish/Lib/ArrayUtils.php');
require(ROOT . '/GoFish/Collection/LinkedListCollection.php');
require(ROOT . '/GoFish/Collection/TypedCollection.php');
require(ROOT . '/GoFish/Collection/PlayerCollection.php');

require(ROOT . '/GoFish/Scorable.php');
require(ROOT . '/GoFish/Logic/Decidable.php');
require(ROOT . '/GoFish/Logic/BotDecider.php');
require(ROOT . '/GoFish/Logic/LoggedBotDecider.php');
require(ROOT . '/GoFish/Logic/ConsoleDecider.php');
require(ROOT . '/BlackJack/Card.php');
require(ROOT . '/Blackjack/Deck.php');
require('Pool.php');
require(ROOT . '/Blackjack/Hand.php');
require(ROOT . '/GoFish/Hand.php');
require('Player.php');
require('Bot.php');
require('Turn.php');
require('Book.php');
require(ROOT . '/Blackjack/BlackjackPlayer.php');
require('DealingService.php');
require('Game.php');

require('PlayGameCommand.php');
