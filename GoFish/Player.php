<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Card;
use LearnPhp\GoFish\Collection\PlayerCollection;
use LearnPhp\GoFish\Logic\Decidable;
use LearnPhp\GoFish\Logic\ConsoleDecider;

class Player implements Scorable {
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
     * @var null|Decidable
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
        return $this;
    }
    
    /**
     * Adds $cards to the Player's Hand.
     * @param Card[] $cards
     * @return \LearnPhp\GoFish\Player
     */
    public function addCards(array $cards) {
        foreach ($cards as $card) {
            $this->addCard($card);
        }
        return $this;
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
     * Uses $decider as the decider.
     * @param Decidable $decider
     * @return \LearnPhp\GoFish\Player
     */
    public function setDecider(Decidable $decider) {
        $this->decider = $decider;
        return $this;
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
     * Removes and returns all cards matching $card's rank.
     * @param Card $card
     * @return null|Card[]
     */
    public function requestCards(Card $card) {
        $surrendered = $this->hand->removeAllMatchingRank($card);
        return $surrendered ?: null;
    }
    
    /**
     * @return string
     */
    public function __toString() {
        return $this->getName();
    }
    
    public function score() {
        return $this->getHand()->score();
    }
}