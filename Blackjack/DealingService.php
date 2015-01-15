<?php
header ('Content-type: text/plain');
include_once('Card.php');
include_once('Hand.php');
include_once('Deck.php');
include_once('Player.php');

class DealingService {
    
    public function __construct(Deck $deck, Dealer $dealer);
    
}