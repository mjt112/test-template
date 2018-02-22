<?php namespace Src;

use function array_diff;
use function array_rand;
use function shuffle;

class Deck
{
  private $cards;

  public function __construct()
  {
    $this->cards = range(1, 52);
  }

  public function deckSize() {
    return count($this->cards);
  }

  public function drawFirstHand() {
    return array_rand(array_flip($this->cards), 26);
  }

  public function drawSecondHand($hand) {
    $cards = array_diff($this->cards, $hand);
    shuffle($cards);
    return $cards;
  }
}