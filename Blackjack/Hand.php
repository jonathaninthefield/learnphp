<?php
// header('Content-Type: text/plain');
include_once('Card.php');
include_once('Deck.php');

class Hand {
	protected $cards = array();
	
	public function addCard(Card $card) {
		$this->cards[] = $card;
	}
	
	public function removeCard(Card $card) {
		foreach ($this->cards as $index => $handCard) {
			if ($handCard === $card) {
				unset($this->cards[$index]);
			}
		}
	}
	
	public function getValue() {
		$sum = 0;
		foreach ($this->cards as $card) {
			$sum += $card->getValue();
		}
		return $sum;
	}
	
    public function showHand() {
        foreach ($this->cards as $card) {
            $card->toImage();
        }
    }
    
	public function __toString() {
		return "Value: " . $this->getValue() . ' (' . implode(', ', $this->cards) . ')';
	}
}

// $cards = array(
	// new Card('a', 's'),
	// new Card(8, 'd'),
    // new Card('K', 'h')
// );

// $hand = new Hand();
// $hand->addCard($cards[0]);
// $hand->addCard($cards[1]);
// $hand->addCard($cards[2]);
// var_dump($hand);
// // echo $hand;

// $deck = new Deck();
// $hand = new Hand();

// // $deck->drawCard();
// $drawnCard = $deck->drawCard();
// $hand->addCard($drawnCard);
// $drawnCard = $deck->drawCard();
// $hand->addCard($drawnCard);
// $hand->showHand();