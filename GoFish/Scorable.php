<?php
namespace LearnPhp\GoFish;

/**
 * Returns a score.
 */
interface Scorable {
    /**
     * Returns the score.
     * @return int
     */
    public function score();
}