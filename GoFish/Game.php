<?php
namespace LearnPhp\GoFish;
use LearnPhp\GoFish\Hand;
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
     * Determines the winner of the game.
     * @return Player
     * @throws \LogicException
     */
    public function getWinner() {
        if ($this->inProgress) {
            throw new \LogicException(
                "Winner cannot be chosen while game is in progress."
            );
        }
        
        $winner = null;
        foreach ($this->players as $player) {
            if (!$winner) {
                $winner = $player;
                continue;
            } else if ($player->score() === $winner->score()) {
                if (count($player->getHand()) < count($winner->getHand())) {
                    $winner = $player;
                    continue;
                }
            } else if ($player->score() > $winner->score()) {
                $winner = $player;
            }
        }
        return $winner;
    }
    
    /**
     * @return bool|Turn
     */
    public function nextTurn() {
        if (!$this->inProgress) {
            return false;
        }
        
        $asker = $this->findNextAsker();
        if (!$asker) {
            $this->inProgress = false;
            return false;
        }
        return $this->turn = new Turn($asker, $this->pool);
    }
    
    /**
     * @return Pool
     */
    public function getPool() {
        return $this->pool;
    }
        
    /**
     * Finds the next Player who can ask.
     * @return null|Player
     */
    protected function findNextAsker() {
        if (!$this->turn) {
            return $this->players[0];
        } else if (!count($this->pool)) {
            return null;
        }
        $last = $this->turn->getAsker();
        $marker = null;
        foreach ($this->players as $k => $v) {
            if ($last == $v) {
                $marker = $k;
                continue;
            }
            if ($this->canPlay($v)) {
                return $v;
            }
        }
        foreach ($this->players as $k => $v) {
            if ($marker === $k) {
                return null;
            }
            if ($this->canPlay($v)) {
                return $v;
            }
        }
        return null;
    }
    
    /**
     * Determines if $player can play.
     * @param \LearnPhp\GoFish\Player $player
     * @return boolean
     */
    protected function canPlay(Player $player) {
        if (!$this->inProgress) {
            return false;
        } else if ($player->getHand()->isOuttaCards()) {
            return false;
        }
        return true;
    }
}

