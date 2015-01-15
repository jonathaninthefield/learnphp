<?php
namespace LearnPhp\GoFish;

class DealingService {
    /**
     * @var Pool
     */
    protected $pool;
    
    /**
     * @var Player[]
     */
    protected $players = array();
    
    public function __construct(Pool $pool, array $players) {
        $this->pool = $pool;
        $this->players = $players;
        foreach ($players as $player) {
            if (!($player instanceof Player)) {
                throw new \Exception("Players must be instances of Player.");
            }
        }
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