<?php
namespace LearnPhp\GoFish;
use LearnPhp\GoFish\Player;
use LearnPhp\GoFish\Logic\Decidable;
use LearnPhp\GoFish\Logic\BotDecider;

class Bot extends Player implements Decidable {
    /**
     * The decision maker for this Bot.
     * @var null|BotDecider
     */
    protected $decider;
    
    /**
     * Gets the bot's decision maker.
     * @return BotDecider
     */
    public function getDecider() {
        if (!$this->decider) {
            $this->decider = new BotDecider($this);
        }
        return $this->decider;
    }
}