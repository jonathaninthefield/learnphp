<?php
namespace LearnPhp\Blackjack;
use LearnPhp\GoFish\Player;

class BlackjackPlayer extends Player {
    protected $money;
    protected $bet;
    
    public function __construct($name, $money) {
        parent::__construct($name);
        $this->money = $money;
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