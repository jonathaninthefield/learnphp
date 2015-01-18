<?php
namespace LearnPhp\GoFish\Logic;
use LearnPhp\GoFish\Collection\PlayerCollection;

interface Decidable {
    /**
     * Chooses an askee from $players.
     * @param \LearnPhp\GoFish\Logic\PlayerCollection $players
     * @return \LearnPhp\GoFish\Player
     */
    public function chooseAskee(PlayerCollection $players);
    
    /**
     * Chooses a card to request.
     * @return \LearnPhp\Blackjack\Card
     */
    public function chooseCard();
}