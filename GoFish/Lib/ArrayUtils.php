<?php
namespace LearnPhp\GoFish\Lib;

/**
 * Helper methods for operating on arrays.
 */
class ArrayUtils {
    /**
     * Asserts $elements is an array, or Traversable.
     * @param array|\Traversable $elements
     * @return array|\Traversable $elements instance
     * @throws \InvalidArgumentException
     */
    public static function assertTraversable($elements) {
        if (!is_array($elements) && !($elements instanceof \Traversable)) {
            throw new \InvalidArgumentException(
                "Expected Traversable or array. Received: " . gettype($elements)
            );
        }
        return $elements;
    }
    
    /**
     * Converts $elements to array if not already.
     * @param array|\Traversable $elements
     * @return array
     * @throws \InvalidArgumentException
     */
    public static function toArray($elements) {
        static::assertTraversable($elements);
        if (is_array($elements)) {
            return $elements;
        }
        $return = array();
        foreach ($elements as $element) {
            $return[] = $element;
        }
        return $return;
    }
}