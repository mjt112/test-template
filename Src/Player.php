<?php namespace Src;

use function rand;

class Player
{
  private $hand;

  public function __construct()
  {
    $this->hand = null;
  }

  public function handSize() {
    return count($this->hand);
  }

  public function setHand($hand) {
    $this->hand = $hand;
  }

  public function drawCardFromHand($handPosition) {
    $index = isset($handPosition) ? $handPosition : rand(0, ($this->handSize() -1));
    $card = $this->hand[$index];
    unset($this->hand[$index]);
    $newHand = array_values($this->hand);
    $this->setHand($newHand);
    return $card;
  }

  public function addCardsFromWinningRound($card1, $card2) {
    $hand = $this->hand;
    array_push($hand, $card1, $card2);
    $this->setHand($hand);
  }
}