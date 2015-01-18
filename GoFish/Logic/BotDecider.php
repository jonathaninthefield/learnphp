<?php
namespace LearnPhp\GoFish\Logic;
use LearnPhp\GoFish\Collection\PlayerCollection;
use LearnPhp\Blackjack\Card;
use LearnPhp\GoFish\Player;

class BotDecider implements Decidable {
    /**
     * The bot making the decision.
     * @var Player
     */
    protected $bot;
    
    public function __construct(Player $bot) {
        $this->bot = $bot;
    }
    
    /**
     * Chooses a Player to ask from $players.
     * @param PlayerCollection $players
     * @return Player
     * @throws \InvalidArgumentException
     */
    public function chooseAskee(PlayerCollection $players) {
        if ($players->isEmpty()) {
            throw new \InvalidArgumentException(
                '$players must have at least one Player for choosing.'
            );
        }
        return $players->random()->first();
    }
    
    /**
     * Chooses a Card to ask for from the hand.
     * @return null|Card Returns null when there are no more cards to choose.
     */
    public function chooseCard() {
        if (!count($this->bot->getHand())) {
            return null;
        }
        return $this->bot->getHand()->getRandomCard();
    }
}