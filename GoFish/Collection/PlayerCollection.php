<?php
namespace LearnPhp\GoFish\Collection;
use LearnPhp\GoFish\Player;

/**
 * A collection of Player.
 */
class PlayerCollection extends TypedCollection {
    protected static $type = Player::KLASS;
    
    
    ### Below are overridden to assist IDE TypeHinting ###
    
    /**
     * Constructs the collection, initialized with $elements.
     * @param Player[]|\Traversable $elements
     */
    public function __construct($elements = array()) {
        parent::__construct($elements);
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
    public function push($element) {
        return parent::push($element);
    }
    
    /**
     * Returns the first element from the collection.
     * @return Player
     */
    public function first() {
        return parent::first();
    }
    
    /**
     * Selects $num random elements as a collection.
     * 
     * Invoking this with $num == count() will effectively return a randomized
     *  array.
     * @param int $num The number of elements to select.
     * @return PlayerCollection
     */
    public function random($num = 1) {
        return parent::random($num);
    }
    
    /**
     * Returns a new collection without elements from $elements.
     * @param array|\Traversable $elements
     * @return PlayerCollection
     * @throws \InvalidArgumentException
     */
    public function diff($elements) {
        return parent::diff($elements);
    }
    
    /**
     * Joins the collection values together with $glue as a string.
     * @param string $glue
     * @return string
     */
    public function join($glue) {
        return implode($glue, $this->toArray());
    }
}