<?php namespace Src;

class War
{
  public $playerOne;

  public $playerTwo;

  private $deck;

  public function __construct()
  {
    $this->deck = new Deck();
    $this->playerOne = new Player();
    $this->playerTwo = new Player();
  }

  public function compare($card1, $card2) {
    return $card1 > $card2 ? $card1 : $card2;
  }

  public function distributeHands() {
    $firstHand = $this->deck->drawFirstHand();
    $secondHand = $this->deck->drawSecondHand($firstHand);
    $this->playerOne->setHand($firstHand);
    $this->playerTwo->setHand($secondHand);
  }

  public function playARound($player1CardPosition = null, $player2CardPosition = null) {
    $player1Card = $this->playerOne->drawCardFromHand($player1CardPosition);
    $player2Card = $this->playerTwo->drawCardFromHand($player2CardPosition);

    if($this->compare($player1Card, $player2Card) === $player1Card) {
      $this->playerOne->addCardsFromWinningRound($player1Card, $player2Card);
      return 'Player 1 Wins The Round';
    } else {
      $this->playerTwo->addCardsFromWinningRound($player2Card, $player1Card);
      return 'Player 2 Wins The Round';
    }
  }

  public function playAGame() {
    while($this->playerOne->handSize() > 0 && $this->playerTwo->handSize() > 0) {
      $this->playARound();
    }

    return $this->playerOne->handSize() > 0 ? "Player 1 Wins The Game" : "Player 2 Wins The Game";
  }
}