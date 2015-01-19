<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Card;

class Hand extends \LearnPhp\Blackjack\Hand implements Scorable {
    protected $books = array();
    
    public function addCard(\LearnPhp\Blackjack\Card $card) {
        parent::addCard($card);
        $this->tryBook($card);
    }
    
    /**
     * Tries to create a book from cards in hand matching $card.
     * @param Card $card
     * @return \LearnPhp\GoFish\Hand
     */
    protected function tryBook(Card $card) {
        $cards = array($card);
        foreach ($this->cards as $compare) {
            if ($card->matchesRank($compare)) {
                $cards[] = $compare;
            }
        }
        if (count($cards) !== 4) {
            return $this;
        }
        $this->removeAllMatchingRank($card);
        $this->books[] = new Book($cards);
        return $this;
    }
    
    /**
     * Determines if the Hand has no more Cards.
     * @return bool
     */
    public function isOuttaCards() {
        return count($this->cards) === 0;
    }
    
    /**
     * Gets the score (number of Books).
     * @return int
     */
    public function score() {
        return count($this->books);
    }
}