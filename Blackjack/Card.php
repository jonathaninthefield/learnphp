<?php

namespace LearnPhp\Blackjack;

// header('Content-Type: text/plain');

/*
  Suit, number, value
 */
class Card
{

    protected $number; // string
    protected $suit; // string
    protected $value; // int
    protected $image; // string

    public function __construct($number, $suit)
    {
        $this->setNumber($number);
        $this->setSuit($suit);
        $this->setImage($number, $suit);
    }

    protected function setSuit($suit)
    {
        $this->suit = strtoupper($suit);
        $validSuits = array('S', 'H', 'D', 'C');
        if (!in_array($this->suit, $validSuits)) {
            throw new Exception($this->suit . " is not a valid Card suit.");
        }
    }

    protected function setNumber($number)
    {
        $this->number = strtoupper($number);
        $validNumbers = array('A', 'J', 'Q', 'K', 2, 3, 4, 5, 6, 7, 8, 9, 10);
        if (!in_array($this->number, $validNumbers)) {
            throw new Exception($this->number . " is not a valid Card number.");
        }

        $this->setValue($this->number);
    }

    protected function setImage($number, $suit)
    {
        $this->image = "$number" . "$suit";
    }

    public function isAce()
    {
        if ($this->number == 'A') {
            return true;
        } else {
            return false;
        }
    }

    protected function setValue($number)
    {
        switch ($number):
            case 'A':
                $this->value = 1;
                break;

            case 'J':
            case 'Q':
            case 'K':
                $this->value = 10;
                break;

            default:
                $this->value = $number;
        endswitch;
    }
    
    public function getNumber()
    {
        return $this->number;
    }
    
    public function getValue()
    {
        return $this->value;
    }

    public function getSuit()
    {
        return $this->suit;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function toImage()
    {
        echo "<img height=\"500\" src='images\\{$this->image}.svg' />";
    }

    public function __toString()
    {
        return $this->number . $this->suit . ' (' . $this->value . ')';
    }
    
    /**
     * Returns true if the card matches this one's value.
     * @param string $value
     * @return bool
     */
    public function matches($value) {
        return strtoupper($value) === ($this->number . $this->suit);
    }
    
    /**
     * Returns true if the card matches this one's value.
     * @param Card $card
     * @return bool
     */
    public function matchesRank(Card $card) {
        return trim($this->getNumber()) === trim($card->getNumber());
    }
}

// $suits = array("H", "S", "D", "C");
// $numbers = array("A", "Q", "K", "J", 2, 3, 4, 5, 6, 7, 8, 9, 10);

// foreach ($suits as $suit) {
    // foreach ($numbers as $number) {
        // $card = new Card($number, $suit);
        // $card->toImage();
        // echo "\n\n";
    // }
// }


