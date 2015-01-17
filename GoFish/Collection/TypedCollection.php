<?php
namespace LearnPhp\GoFish\Collection;

/**
 * A collection with an enforced type.
 */
class TypedCollection extends LinkedListCollection {
    protected static $type = '\stdClass';
    
    public function __construct($elements = array()) {
        if (!class_exists(static::$type)) {
            throw new \LogicException(static::$type . " class not found.");
        }
        parent::__construct($elements);
    }
    
    /**
     * Enforces $element as the type
     * @param mixed $element
     * @return TypedCollection
     */
    protected function enforceType($element) {
        if ($element instanceof static::$type) {
            return $this;
        }
        
        throw new \InvalidArgumentException(
            "Collection expects a " . static::$type . ". Received: "
                . gettype($element)
        );
    }    

    /**
     * Sets $offset to $value.
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value) {
        $this->enforceType($value);
        parent::offsetSet($offset, $value);
    }
    
    /**
     * Adds $element to the collection.
     * @param mixed $element
     * @return TypedCollection
     */
    public function push($element) {
        $this->enforceType($element);
        return parent::push($element);
    }
}