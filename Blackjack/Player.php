<?php
header ('Content-type: text/plain');
include_once('Card.php');
include_once('Hand.php');

class Player {
    protected $name;
    protected $money;
    protected $hand;
    protected $bet;
    
    public function __construct($name, $money) {
        $this->name = $name;
        $this->money = $money;
    }

    public function getName() {
        return $this->name;
    }
    
    public function addCard(Card $card) {
        $this->hand->addCard($card);
    }

    public function setHand(Hand $hand) {
        $this->hand = $hand;
    }

    protected function collectWinnings($winnings) {
        $this->money = $this->money + $winnings;
    }

    protected function setBet($bet) {
        $this->bet = $bet;
    }
    
    public function getBet() {
        return $bet;
    }
    
    public function bust() {
        $this->money = $this->money - $bet;
    }

    
    
    
    
}