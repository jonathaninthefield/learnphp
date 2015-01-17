<?php
namespace LearnPhp\GoFish\Collection;
use LearnPhp\GoFish\Player;

/**
 * A collection of Player.
 */
class PlayerCollection extends ArrayCollection {
    
    /**
     * Constructs the collection, initialized with $elements.
     * @param Player[]|\Traversable $elements
     */
    public function __construct($elements = array()) {
        parent::__construct($elements);
    }
    
    /**
     * Enforces $element as Player.
     * @param Player $element
     * @return PlayerCollection
     */
    protected function enforceType(Player $element) {
        if ($element instanceof Player) {
            return $this;
        }
        
        throw new \InvalidArgumentException(
            "PlayerCollection expects a Player. Received: " . gettype($element)
        );
    }    

    /**
     * Returns the value at $offset.
     * @param mixed $offset
     * @return Player
     */
    public function offsetGet($offset) {
        return parent::offsetGet($offset);
    }

    /**
     * Sets $offset to $value.
     * @param mixed $offset
     * @param Player $value
     */
    public function offsetSet($offset, $value) {
        $this->enforceType($value);
        parent::offsetSet($offset, $value);
    }

    /**
     * Returns the current element.
     * @return Player
     */
    public function current() {
        return parent::current();
    }
    
    /**
     * Adds $element to the collection.
     * @param Player $element
     * @return PlayerCollection
     */
    public function push(Player $element) {
        $this->enforceType($element);
        return parent::push($element);
    }
}