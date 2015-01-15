<?php
// header('Content-Type: text/plain');
include_once('Card.php');

class Deck {
    protected $cards = array();
    
    public function __construct() {
        $suits = array("H", "S", "D", "C");
        $numbers = array("A", "Q", "K", "J", 2, 3, 4, 5, 6, 7, 8, 9, 10);
        foreach ($suits as $suit) {
            foreach ($numbers as $number) {
                $card = new Card($number, $suit);
                $this->cards[] = $card;
            }
        }
        shuffle($this->cards);
    }
    
    public function shuffleDeck() {
        shuffle($this->cards);
    }

    public function drawCard() {
        $drawnIndex = array_rand($this->cards);
        $drawnCard = $this->cards[$drawnIndex];
        unset ($this->cards[$drawnIndex]);
        return $drawnCard;
    }
    
    public function __toString() {
        return "Deck card order is now: " . implode(', ', $this->cards) . ')';
    }
}
    
// $deck = new Deck();
// $deck->drawCard();
// $deck->drawCard();