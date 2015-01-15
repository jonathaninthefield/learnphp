<?php

/**
 * A playing card.
 * 
 * Each card has:
 * - suit (string)
 * - number (string)
 * - value (integer)
 */
class Card
{
    private $suit;
    private $number;
    
    public function __construct($number, $suit)
    {
        $this->suit = $suit;
        $this->number = $number;
    }
    
    public function getValue()
    {
        /**
         * CARD NUMBER --> CARD VALUE
         * A --> 1 or 11
         * 2-10 --> same as number ("number is between 2 and 10" == "number is greater than or equal to two AND number is less than or equal to 10")
         * J, Q, K --> 10
         */
        if ($this->number === 'A') {
            // Todo: determine if it should be one or eleven
            return 11;
        } else if ($this->number >= 2 && $this->number <= 10) {
            return $this->number;
        } else {
            return 10;
        }
    }
    
    public function getNumber()
    {
        return $this->number;
    }
    
    public function getSuit()
    {
        return $this->suit;
    }
    
    public function toString()
    {
        return $this->number . $this->suit;
    }
}
