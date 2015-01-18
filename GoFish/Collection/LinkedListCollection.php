<?php
namespace LearnPhp\GoFish\Collection;
use LearnPhp\GoFish\Lib\ArrayUtils;

/**
 * A generic collection.
 */
class LinkedListCollection implements \Iterator, \ArrayAccess, \Countable {
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
     * Does the collection have any elements?
     * @return bool
     */
    public function isEmpty() {
        return count($this) === 0;
    }
    
    /**
     * Returns the first element from the collection.
     * @return mixed
     */
    public function first() {
        return $this->storage->bottom();
    }
    
    /**
     * Selects $num random elements as a collection.
     * 
     * Invoking this with $num == count() will effectively return a randomized
     *  array.
     * @param int $num The number of elements to select.
     * @return LinkedListCollection
     */
    public function random($num = 1) {
        /* Sebil <http://php.net/manual/en/function.array-rand.php#105265>
         *  recommends using shuffle() rather than array_rand().
         */
        $array = $this->toArray();
        shuffle($array);
        return new static(array_slice($array, 0, $num));
    }
    
    /**
     * Returns the collection as an array.
     * @return array
     */
    public function toArray() {
        $return = array();
        foreach ($this as $k => $v) {
            $return[$k] = $v;
        }
        return $return;
    }

    /**
     * Merges $elements into the collection.
     * @param \Traversable|array $elements
     * @return \LearnPhp\GoFish\Collection\LinkedListCollection
     * @throws \InvalidArgumentException
     */
    public function merge($elements) {
        ArrayUtils::assertTraversable($elements);
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
        return $this->storage->offsetGet($offset);
    }

    /**
     * Sets $offset to $value.
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value) {
        $this->storage->offsetSet($offset, $value);
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
     * @return \LearnPhp\GoFish\Collection\LinkedListCollection
     */
    public function push($element) {
        $this->storage->push($element);
        return $this;
    }
    
    /**
     * Returns the index for $element.
     * @param mixed $element
     * @return null|int
     */
    public function getAt($element) {
        foreach ($this->storage as $k => $v) {
            if ($v == $element) {
                return $k;
            }
        }
        return null;
    }
    
    /**
     * Determines if $element is contained in the collection.
     * @param mixed $element
     * @return bool
     */
    public function contains($element) {
        return $this->getAt($element) !== null;
    }
    
    /**
     * Returns a new collection without elements from $elements.
     * @param array|\Traversable $elements
     * @return LinkedListedCollection
     * @throws \InvalidArgumentException
     */
    public function diff($elements) {
        return new static(
            array_diff($this->toArray(), ArrayUtils::toArray($elements))
        );
    }
}
