<?php
namespace LearnPhp\GoFish;

/**
 * Interacts with the user via I/O to play a game.
 */
class PlayGameCommand {
    /**
     * @var Player
     */
    protected $user;
    
    public function run() {
        IoUtils::out("Let's play a game of Go Fish!");
        
        $game = new Game();
        foreach ($this->promptPlayers() as $player) {
            $game->addPlayer($player);
        }
        $game->start();
    }
    
    /**
     * @return \LearnPhp\GoFish\Player[]
     */
    protected function promptPlayers() {
        $players = array();
        $name = IoUtils::prompt("Please enter your player name.");
        $players[] = $this->user = new Player($name);
        
        $message = "Enter another player name, or hit enter.";
        while ($name = IoUtils::prompt($message)) {
            $players[] = new Player($name);
        }
        return $players;
    }
}