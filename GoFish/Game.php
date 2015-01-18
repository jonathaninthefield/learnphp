<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Hand;
use LearnPhp\GoFish\Collection\PlayerCollection;

/**
 * Go Fish
 * 
 * Played by 2-10 players. At the beginning of the game, 7 cards are dealt. If
 *  there are more than 4 players, 5 cards are dealt.
 */
class Game {
    /**
     * @var Player[]|PlayerCollection
     */
    protected $players;
    
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
    
    /**
     * @var null|Turn The current turn.
     */
    protected $turn;
    
    public function __construct()
    {
        $this->pool = new Pool();
        $this->players = new PlayerCollection();
    }
    
    /**
     * @param Player $player
     * @return Game
     */
    public function addPlayer(Player $player) {
        $this->players[] = $player;
        return $this;
    }
    
    /**
     * @return Player[]|PlayerCollection
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
     * @return Game
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
        reset($this->players);
        return $this;
    }
    
    /**
     * @return bool|Turn
     */
    public function nextTurn() {
        if (!$this->turn) {
            $asker = $this->players[0];
        } else {
            $asker = next($this->players) ?: reset($this->players);
        }
        $next = new Turn($asker, $this->pool);
        return $next;
    }
}

