<?php

// Create BlackjackHand class as a subclass of Hand

// Hand will return a value of 8 when it has an Ace and a 7

// Make BlackjackHand return a value of 18 when it has an Ace and a 7

include_once ('BlackjackCard.php');
include_once ('Hand.php');

class BlackjackHand extends Hand {
	
	public function getValue() {
		$sum = parent::getValue();
		$aceFound = false;
		foreach ($this->cards as $handCard) {
			if ($handCard->isAce()){
				$aceFound = true;
			}
		}
		if ($aceFound && $sum <= 11) {
			$sum += 10;
		}
		return $sum;
	}
	
	
}

// $cards = array(
    // new card('A', 'S'),
    // new card('5', 'C'),
    // new card('K', 'H')
// );

// $blackjackHand = new BlackjackHand();

// $blackjackHand->addCard($cards[0]);
// $blackjackHand->addCard($cards[1]);
// $blackjackHand->addCard($cards[2]);


// echo $blackjackHand . "\n";