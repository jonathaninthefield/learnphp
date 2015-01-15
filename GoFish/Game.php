<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Hand;

class Game {
    /**
     * @var Player[]
     */
    protected $players = array();
    
    /**
     * @var Pool
     */
    protected $pool;
    
    /**
     * @var null|DealingService
     */
    protected $dealingService;
    
    /**
     * @var bool
     */
    protected $inProgress = false;
    
    public function __construct()
    {
        $this->pool = new Pool();
    }
    
    /**
     * @param Player $player
     */
    public function addPlayer(Player $player) {
        $this->players[] = $player;
    }
    
    /**
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }
        
    /**
     * Starts a game of GoFish.
     * 
     * All players should be added at this point. Cards are dealt to each player
     *  and the first turn begins.
     */
    public function start() {
        if ($this->inProgress) {
            throw new \RuntimeException("A game in-progress cannot be started.");
        } else if (count($this->players) < 2 || count($this->players) > 10) {
            throw new \LengthException(
                "GoFish requires between 2 and 10 players, inclusive."
            );
        }
        
        foreach ($this->players as $player) {
            $player->setHand(new Hand());
        }
        
        $dealingService = new DealingService($this->pool, $this->players);
        $dealingService->deal();
        
        $this->inProgress = true;
    }
}

