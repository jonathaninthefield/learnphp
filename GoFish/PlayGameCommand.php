<?php
namespace LearnPhp\GoFish;
use LearnPhp\GoFish\Player;
use LearnPhp\GoFish\Game;
use LearnPhp\GoFish\Turn;

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
    
    public function run() {
        IoUtils::out("Let's play a game of Go Fish!");
        
        $game = new Game();
        foreach ($this->promptPlayers() as $player) {
            $game->addPlayer($player);
        }
        $game->start();
        
        while ($turn = $game->nextTurn()) {
            $this->showHand($turn);
            $askee = $this->promptAskee($turn);
            $requestedCard = $this->promptCard($turn);
            $turn->ask($askee)->for($requestedCard);
        }
    }
    
    /**
     * Returns array of players without $player.
     * @param Player $player
     * @return Player[]
     */
    protected function getAskeesFor(Player $player) {
        return array_diff(
            $this->game->getPlayers(), array($player)
        );
    }
    
    /**
     * Gets an askee for $turn.
     * @param Turn $turn
     * @return Player
     */
    protected function promptCard(Turn $turn) {
        $asker = $turn->getAsker();
        if ($asker instanceof Bot) {
            return $asker->chooseCard();
        }
        
        return IoUtils::prompt(sprintf(
            "What card do you want to ask %s for? [%s]",
            $turn->getAskee(),
            implode(', ', $asker->getHand()->getCards())
        ));
    }
    
    /**
     * Gets an askee for $turn.
     * @param Turn $turn
     * @return Player
     */
    protected function promptAskee(Turn $turn) {
        $asker = $turn->getAsker();
        if ($asker instanceof Bot) {
            return $asker->chooseAskee($this->getAskeesFor($asker));
        }
        
        $askees = implode("\n\t- ", $this->getAskeesFor($asker));
        return IoUtils::prompt("Who would you like to ask?\n\t- $askees");
    }
    
    /**
     * Shows the $asker's hand.
     * @return \LearnPhp\GoFish\PlayGameCommand
     */
    protected function showHand(Turn $turn) {
        $count = count($this->user->getHand());
        $cards = implode(' ', $this->user->getHand()->getCards());
        if ($turn->isPlayedByBot()) {
            $cards = preg_replace('/\S/', '*', $cards);
        }
        IoUtils::out(
            $turn->getAsker() . "'s cards: $cards ($count)\n"
        );
        return $this;
    }
    
    /**
     * Prompts the user for player names.
     * @return \LearnPhp\GoFish\Bot[]
     */
    protected function promptPlayers() {
        $players = array();
        $name = IoUtils::prompt("Please enter your player name.");
        $players[] = $this->user = new Player($name);
        
        $message = "Enter another player name, or hit enter.";
        while ($name = IoUtils::prompt($message)) {
            $players[] = new Bot($name);
        }
        return $players;
    }
}