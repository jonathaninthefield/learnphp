<?php
namespace LearnPhp\GoFish\Logic;
use LearnPhp\GoFish\Collection\PlayerCollection;
use LearnPhp\Blackjack\Card;
use LearnPhp\GoFish\Player;
use LearnPhp\GoFish\Lib\ConsoleIo;

/**
 * Make Go Fish decisions using I/O via CLI
 */
class ConsoleDecider implements Decidable {
    /**
     * The player making the decision.
     * @var Player
     */
    protected $player;
    
    /**
     * Adapter to interact with the CLI user.
     * @var ConsoleIo
     */
    protected $io;
    
    public function __construct(Player $player, ConsoleIo $io = null) {
        $this->player = $player;
        $this->io = $io ?: ConsoleIo::instance();
    }
    
    /**
     * Chooses a Player to ask from $players.
     * @param PlayerCollection $players
     * @return Player
     * @throws \InvalidArgumentException
     */
    public function chooseAskee(PlayerCollection $players) {
        if ($players->isEmpty()) {
            throw new \InvalidArgumentException(
                '$players must have at least one Player for choosing.'
            );
        } else if (count($players) === 1) {
            return $players->first();
        }
        
        $askees = $players->join("\n\t- ");
        return $this->io->prompt(
            "Who would you like to ask?\n\t- $askees", function($value) use ($players) {
            foreach ($players as $player) {
                assert($player instanceof Player);
                if ($player->getName() === $value) {
                    return $player;
                }
            }
            return null;
        });
    }
    
    /**
     * Chooses a Card to ask for from the hand.
     * @return null|Card Returns null when there are no more cards to choose.
     */
    public function chooseCard() {
        if (!count($this->player->getHand())) {
            return null;
        }
        
        $cards = $this->player->getHand()->getCards();
        $select = implode(', ', $cards);
        return $this->io->prompt(
            "Which card do you want to ask for? [$select]", function($value) use ($cards) {
            foreach ($cards as $card) {
                assert($card instanceof Card);
                if ($card->matches($value)) {
                    return $card;
                }
            }
            return null;
        });
    }
}