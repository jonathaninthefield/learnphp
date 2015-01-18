<?php

namespace LearnPhp\Blackjack;

use LearnPhp\Blackjack\Card;

class Hand implements \Countable {

    protected $cards = array();

    public function addCard(Card $card) {
        $this->cards[] = $card;
    }
    
    /**
     * Removes and returns all cards matching $card's rank.
     * @param Card $card
     * @return Card[]
     */
    public function removeAllMatchingRank(Card $card) {
        $cards = array();
        foreach ($this->cards as $k => $compare) {
            if ($compare->matchesRank($card)) {
                $cards[] = $compare;
                unset($this->cards[$k]);
            }
        }
        return $cards;
    }
    
    /**
     * Removes $card from the hand.
     * @param Card $card
     * @return null|Card
     */
    public function removeCard(Card $card) {
        foreach ($this->cards as $index => $handCard) {
            if ($handCard === $card) {
                unset($this->cards[$index]);
                return $card;
            }
        }
        return null;
    }

    public function getCards() {
        return $this->cards;
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

    /**
     * Counts the cards in the hands.
     * @param string $mode
     * @return int
     */
    public function count($mode = 'COUNT_NORMAL') {
        return count($this->cards);
    }

    /**
     * Gets and removes a random card from the hand.
     * @return null|Card Null when there are no more cards.
     */
    public function getRandomCard() {
        if (!$this->cards) {
            return null;
        }
        $key = array_rand($this->cards);
        $card = $this->cards[$key];
        unset($this->cards[$key]);
        return $card;
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