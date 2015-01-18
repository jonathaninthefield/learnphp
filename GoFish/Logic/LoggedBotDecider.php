<?php
namespace LearnPhp\GoFish\Logic;
use LearnPhp\GoFish\Lib\FilePrompter;
use LearnPhp\GoFish\Player;
use LearnPhp\GoFish\Collection\PlayerCollection;

class LoggedBotDecider extends \LearnPhp\GoFish\Logic\BotDecider {
    /**
     * Prompter to write output to.
     * @var FilePrompter
     */
    protected $prompter;
    
    public function __construct(Player $bot, FilePrompter $prompter) {
        $this->prompter = $prompter;
        parent::__construct($bot);
    }
    
    /**
     * Chooses a Player to ask from $players.
     * @param PlayerCollection $players
     * @return Player
     * @throws \InvalidArgumentException
     */
    public function chooseAskee(PlayerCollection $players) {
        $return = parent::chooseAskee($players);
        $this->prompter->message("Chose to ask " . $return);
        return $return;
    }
    
    /**
     * Chooses a Card to ask for from the hand.
     * @return null|Card Returns null when there are no more cards to choose.
     */
    public function chooseCard() {
        $return = parent::chooseCard();
        $this->prompter->message("Chose to ask for $return");
        return $return;
    }
}