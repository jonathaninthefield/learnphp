<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Card;
use LearnPhp\Blackjack\Hand;
use LearnPhp\GoFish\Logic\ConsoleDecider;
use LearnPhp\GoFish\Collection\PlayerCollection;

class Player {
    const KLASS = __CLASS__;
    
    /**
     * The Player's name.
     * @var string
     */
    protected $name;
    
    /**
     * The Player's hand.
     * @var null|Hand
     */
    protected $hand;
    
    /**
     * The decision maker for this Player.
     * @var null|ConsoleDecider
     */
    protected $decider;
    
    public function __construct($name) {
        $this->name = $name;
    }

    /**
     * Gets the Player's name.
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Adds a card to the player's hand.
     * @param Card $card
     * @throws \LogicException
     */
    public function addCard(Card $card) {
        if (!$this->hand) {
            throw new \LogicException(
                "No Player Hand has been set to add a card to."
            );
        }
        $this->hand->addCard($card);
    }

    /**
     * Sets $hand as the hand.
     * @param Hand $hand
     * @return \LearnPhp\GoFish\Player
     */
    public function setHand(Hand $hand) {
        $this->hand = $hand;
        return $this;
    }
    
    /**
     * @return Hand
     */
    function getHand()
    {
        return $this->hand;
    }
    
    /**
     * Gets the decision maker for the Player.
     * @return ConsoleDecider
     */
    public function getDecider() {
        if (!$this->decider) {
            $this->decider = new ConsoleDecider($this);
        }
        return $this->decider;
    }
    
    /**
     * Chooses the Player to request a Card from.
     * @param PlayerCollection $players
     * @return Player
     */
    public function chooseAskee(PlayerCollection $players) {
        return $this->getDecider()->chooseAskee($players);
    }

    /**
     * Chooses a Card to request.
     * @return Card
     */
    public function chooseCard() {
        return $this->getDecider()->chooseCard();
    }
    
    /**
     * @return string
     */
    public function __toString() {
        return $this->getName();
    }
}