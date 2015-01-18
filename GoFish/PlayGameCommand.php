<?php
namespace LearnPhp\GoFish;
use LearnPhp\GoFish\Player;
use LearnPhp\GoFish\Game;
use LearnPhp\GoFish\Turn;
use LearnPhp\GoFish\Bot;
use LearnPhp\GoFish\Lib\Prompter;

/**
 * Interacts with the user via I/O to play a game.
 */
class PlayGameCommand {
    /**
     * @var null|Player
     */
    protected $user;
    
    /**
     * @var null|Game
     */
    protected $game;
    
    /**
     * @var null|Turn
     */
    protected $currentTurn;
    
    /**
     * Object to read/write from.
     * @var Prompter
     */
    protected $io;
    
    public function __construct(Prompter $io) {
        $this->io = $io;
    }
    
    public function run() {
        $this->io->message("Let's play a game of Go Fish!");
        
        $this->game = new Game();
        foreach ($this->promptPlayers() as $player) {
            $this->game->addPlayer($player);
        }
        $this->game->start();
        
        while ($this->currentTurn = $this->game->nextTurn()) {
            $askee = $this->currentTurn->getAsker()->chooseAskee(
                $this->getAskeesFor($this->currentTurn->getAsker())
            );
            $requestedCard = $this->currentTurn->getAsker()->chooseCard();
            
            $surrendered = $this->currentTurn->ask($askee)->for($requestedCard);
            if ($surrendered) {
                $this->io->message(sprintf(
                    "Awesome! %s had %d %s.",
                    $askee, 
                    $surrendered, 
                    $requestedCard->getNumber(),
                    $surrendered > 1 ? 's' : ''
                ));
            } else {
                $this->io->message("Go Fish! ");
            }
            exit;
        }
    }
    
    /**
     * Returns array of players without $player.
     * @param Player $player
     * @return Player[]
     */
    protected function getAskeesFor(Player $player) {
        return $this->game->getPlayers()->diff(array($player));
    }
    
    /**
     * Prompts the user for player names.
     * @return \LearnPhp\GoFish\Player[]
     */
    protected function promptPlayers() {
        $players = array();
        $name = $this->io->prompt("Please enter your player name.");
        $players[] = $this->user = new Player($name);
        
        $message = "Enter another player name, or hit enter.";
        while ($name = $this->io->prompt($message)) {
            $players[] = new Bot($name);
        }
        return $players;
    }
}