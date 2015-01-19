<?php
namespace LearnPhp\Blackjack;

/**
 * Represents a standard 52-card deck.
 * 
 * Upon instantiation, all the cards will be in order.
 */
class Deck implements \Countable {
    protected $cards = array();
    
    public function __construct() {
        $suits = array("H", "S", "D", "C");
        $numbers = array("A", 2, 3, 4, 5, 6, 7, 8, 9, 10, "J", "Q", "K");
        foreach ($suits as $suit) {
            foreach ($numbers as $number) {
                $card = $this->createCard($number, $suit);
                $this->cards[] = $card;
            }
        }
    }
    
    protected function createCard($number, $suit) {
        return new Card($number, $suit);
    }
    
    public function shuffle() {
        shuffle($this->cards);
    }

    public function drawCard() {
        return array_pop($this->cards);
    }
    
    public function __toString() {
        return "Deck card order is now: " . implode(', ', $this->cards) . ')';
    }
    
    public function count($mode = 'COUNT_NORMAL') {
        return count($this->cards);
    }
}
    
// $deck = new Deck();
// $deck->drawCard();
// $deck->drawCard();