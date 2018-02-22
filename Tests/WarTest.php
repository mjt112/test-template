<?php namespace Test;

use PHPUnit\Framework\TestCase;
use function range;
use Src\Deck;
use Src\Player;
use Src\War;

class WarTest extends TestCase
{
  public function testWarClass() {
    $war = new War();

    $this->assertInstanceOf(War::class, $war);
  }

  public function testCompareTwoAndOne() {
    $war = new War();

    $this->assertEquals(2, $war->compare(2, 1));
  }

  public function testCompareThreeAndOne() {
    $war = new War();

    $this->assertEquals(3, $war->compare(3, 1));
  }

  public function testCompareFourAndFive() {
    $war = new War();

    $this->assertEquals(5, $war->compare(4, 5));
  }

  public function testPlayerOne() {
    $this->assertClassHasAttribute('playerOne', War::class);
  }

  public function testPlayerTwo() {
    $this->assertClassHasAttribute('playerTwo', War::class);
  }

  public function testPlayerOneAndTwoPlayerClass() {
    $war = new War();

    $this->assertInstanceOf(Player::class, $war->playerOne);
    $this->assertInstanceOf(Player::class, $war->playerTwo);
  }

  public function testDeckClass() {
    $deck = new Deck();

    $this->assertInstanceOf(Deck::class, $deck);
  }

  public function testPlayerOneHandStartsWithTwentySixCards() {
    $war = new War();

    $war->distributeHands();

    $this->assertEquals(26, $war->playerOne->handSize());
  }

  public function testPlayerTwoHandStartsWithTwentySixCards() {
    $war = new War();

    $war->distributeHands();

    $this->assertEquals(26, $war->playerTwo->handSize());
  }

  public function testDeckHasFiftyTwoCards() {
    $deck = new Deck();

    $this->assertEquals(52, $deck->deckSize());
  }

  public function testPlayARoundWherePlayer2Wins() {
    $war = new War();

    $war->playerOne->setHand(range(1, 26));
    $war->playerTwo->setHand(range(27, 52));

    $this->assertEquals("Player 2 Wins The Round", $war->playARound(0, 0));
  }

  public function testPlayARoundWherePlayer1Wins() {
    $war = new War();

    $war->playerOne->setHand(range(27, 52));
    $war->playerTwo->setHand(range(1, 26));

    $this->assertEquals("Player 1 Wins The Round", $war->playARound(0, 0));
  }

  public function testHandSizeDecreaseAndIncreases() {
    $war = new War();

    $war->playerOne->setHand(range(1, 26));
    $war->playerTwo->setHand(range(27, 52));

    $war->playARound(0, 0);

    $this->assertEquals(25, $war->playerOne->handSize());
    $this->assertEquals(27, $war->playerTwo->handSize());
  }

  public function testPlayAGame() {
    $war = new War();

    $war->playerOne->setHand(range(1, 26));
    $war->playerTwo->setHand(range(27, 52));

    $this->assertEquals("Player 2 Wins The Game", $war->playAGame());
  }

  public function testRandomHandGame() {
    $war = new War();
    $war->distributeHands();

    $this->assertStringEndsWith("Wins The Game", $war->playAGame());
  }
}
