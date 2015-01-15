<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Card;

/**
 * A set of four cards, all of the same rank (number).
 */
class Book {
    /**
     * Contains exactly four cards, all of the same rank (number).
     * @var Card[]
     */
    protected $cards;
    
    public function __construct(array $cards) {
        if (count($cards) !== 4) {
            throw new \InvalidArgumentException("A book requires 4 cards");
        }
        
        $targetNumber = null;
        foreach ($cards as $card) {
            if (!($card instanceof Card)) {
                throw new \InvalidArgumentException(
                    "Book requires a Card instance."
                );
            } else if ($targetNumber === null) {
                $targetNumber = $card->getNumber();
            }
            
            if ($card->getNumber() !== $targetNumber) {
                throw new \InvalidArgumentException(
                    "All Cards in a Book must be of the same number."
                );
            }
        }
        $this->cards = $cards;
    }
}
