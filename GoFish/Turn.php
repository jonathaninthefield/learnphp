<?php
namespace LearnPhp\GoFish;
use LearnPhp\Blackjack\Card;
use LearnPhp\GoFish\Bot;
use LearnPhp\GoFish\Pool;

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
     * @var null|Card[]
     */
    protected $surrenderedCards = null;
    
    /**
     * The card that was fished from the pool, if $askee didn't have a card of
     *  $requestedCard's rank.
     * @var null|Card
     */
    protected $fishedCard;
    
    /**
     * The Pool to fish from.
     * @var Pool
     */
    protected $pool;
    
    public function __construct(Player $asker, Pool $pool)
    {
        $this->asker = $asker;
        $this->pool = $pool;
    }
    
    /**
     * Gets the card the asker fished for.
     * @return null|Card
     */
    public function getFishedCard() {
        return $this->fishedCard;
    }
        
    /**
     * Sets $askee as the Player to ask for a card from.
     * @param \LearnPhp\GoFish\Player $askee
     * @return \LearnPhp\GoFish\Turn
     */
    public function ask(Player $askee) {
        $this->askee = $askee;
        return $this;
    }
    
    /**
     * Requests the askee for cards matching $card's rank.
     * @param Card $card
     * @return null|Card[]
     */
    public function forCard(Card $card) {
        $this->requestedCard = $card;
        $this->surrenderedCards = $this->askee->requestCards($card);
        if (!$this->surrenderedCards) {
            $this->fishedCard = $this->pool->fish();
            $this->asker->addCard($this->fishedCard);
        }
        return $this->surrenderedCards;
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