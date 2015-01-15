<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Deck;
use LearnPhp\Blackjack\Card;

class Pool extends Deck {
    
    /**
     * @return \LearnPhp\Blackjack\Card
     */
    public function fish() {
        return parent::drawCard();
    }
    
    /**
     * @param string $number
     * @param string $suit
     * @return \LearnPhp\Blackjack\Card
     */
    protected function createCard($number, $suit) {
        return new Card($number, $suit);
    }
}