<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Card;
use LearnPhp\GoFish\Bot;

class Turn {
    /**
     * The Player whose turn it is.
     * @var Player
     */
    protected $asker;
    
    /**
     * The Player $asker chose to request a card from.
     * @var null|Player
     */
    protected $askee;
    
    /**
     * The Card $asker requested from $askee;
     * @var null|Card
     */
    protected $requestedCard;
    
    /**
     * The cards the $askee surrendered.
     * @var Card[]
     */
    protected $surrenderedCards = array();
    
    /**
     * The card that was fished from the pool, if $askee didn't have a card of
     *  $requestedCard's rank.
     * @var null|Card
     */
    protected $fishedCard;
    
    public function __construct(Player $asker)
    {
        $this->asker = $asker;
    }
    
    /**
     * 
     * @return bool
     */
    public function isPlayedByBot()
    {
        return $this->asker instanceof Bot;
    }
    
    public function getAsker()
    {
        return $this->asker;
    }
}