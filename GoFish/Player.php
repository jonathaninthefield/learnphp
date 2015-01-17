<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Card;
use LearnPhp\Blackjack\Hand;

class Player {
    protected $name;
    protected $hand;
    
    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
    
    public function addCard(Card $card) {
        if (!$this->hand) {
            throw new \LogicException(
                "No Player Hand has been set to add a card to."
            );
        }
        $this->hand->addCard($card);
    }

    public function setHand(Hand $hand) {
        $this->hand = $hand;
    }
    
    /**
     * @return Hand
     */
    function getHand()
    {
        return $this->hand;
    }
}