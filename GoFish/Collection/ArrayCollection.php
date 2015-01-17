<?php
namespace LearnPhp\GoFish\Collection;

/**
 * A generic collection.
 */
class ArrayCollection implements \Iterator, \ArrayAccess, \Countable {
    /**
     * @var \SplDoublyLinkedList
     */
    protected $storage;
    
    /**
     * Constructs the collection, initialized with $elements.
     * @param array|\Traversable $elements
     */
    public function __construct($elements = array()) {
        $this->storage = new \SplDoublyLinkedList();
        if ($elements) {
            $this->merge($elements);
        }
    }

    /**
     * Merges $elements into the collection.
     * @param \Traversable|array $elements
     * @return \LearnPhp\GoFish\Collection\ArrayCollection
     * @throws \InvalidArgumentException
     */
    public function merge($elements) {
        if (!is_array($elements) && !($elements instanceof \Traversable)) {
            throw new \InvalidArgumentException(
                "Expected Traversable or array. Received: " . gettype($elements)
            );
        }
        foreach ($elements as $element) {
            $this->push($element);
        }
        return $this;
    }
    

    /**
     * Does an element exist at $offset?
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset) {
        return $this->storage->offsetExists($offset);
    }

    /**
     * Returns the value at $offset.
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset) {
        return $this->offsetGet($offset);
    }

    /**
     * Sets $offset to $value.
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value) {
        $this->offsetSet($offset, $value);
    }

    /**
     * Unsets the element at $offset.
     * @param mixed $offset
     */
    public function offsetUnset($offset) {
        $this->storage->offsetUnset($offset);
    }

    /**
     * Size of collection.
     * @param string $mode
     * @return int
     */
    public function count($mode = 'COUNT_NORMAL') {
        return $this->storage->count();
    }

    /**
     * Returns the current element.
     * @return mixed
     */
    public function current() {
        return $this->storage->current();
    }

    /**
     * Gets the key of the current element.
     * @return mixed
     */
    public function key() {
        return $this->storage->key();
    }

    /**
     * Advances the internal pointer.
     */
    public function next() {
        $this->storage->next();
    }

    /**
     * Rewinds internal pointer.
     */
    public function rewind() {
        $this->storage->rewind();
    }

    /**
     * @return bool
     */
    public function valid() {
        return $this->storage->valid();
    }
    
    /**
     * Adds $element to the collection.
     * @param mixed $element
     * @return \LearnPhp\GoFish\Collection\ArrayCollection
     */
    public function push($element) {
        $this->storage->push($element);
        return $this;
    }
}
