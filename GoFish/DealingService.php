<?php
namespace LearnPhp\GoFish;
use LearnPhp\GoFish\Collection\PlayerCollection;

class DealingService {
    /**
     * @var Pool
     */
    protected $pool;
    
    /**
     * @var Player[]|PlayerCollection
     */
    protected $players;
    
    public function __construct(Pool $pool, PlayerCollection $players) {
        $this->pool = $pool;
        $this->players = $players;
    }
    
    /**
     * Deals initial cards to each player.
     * 
     * If the number of player is...
     *  a. Less than 5, then 7 cards are dealt, otherwise
     *  b. 5 cards are dealt.
     */
    public function deal() {
        $this->pool->shuffle();
        $cardsToDeal = count($this->players) < 5 ? 7 : 5;
        
        for ($cardsDealt = 0; $cardsDealt < $cardsToDeal; $cardsDealt++) {
            foreach ($this->players as $player) {
                $player->addCard($this->pool->fish());
            }
        }
    }
}