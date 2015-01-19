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
        $askees = $players->join("\n\t- ");
        $this->prompter->message("Who would you like to ask?\n\t- $askees");
        $this->prompter->message("> " . $return);
        return $return;
    }
    
    /**
     * Chooses a Card to ask for from the hand.
     * @return null|Card Returns null when there are no more cards to choose.
     */
    public function chooseCard() {
        $cards = $this->bot->getHand()->getCards();
        $select = implode(', ', $cards);
        $this->prompter->message("Which card would you like to ask for? [$select]");
        $return = parent::chooseCard();
        $this->prompter->message("> $return");
        return $return;
    }
}