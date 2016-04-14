<?php
namespace FantasyFootball\TournamentCoreBundle\Tests\Util\Rdvbb;

use FantasyFootball\TournamentCoreBundle\Util\Rdvbb\RankingStrategySecondToThird;

class RankingStrategySecondToThirdTest extends \PHPUnit_Framework_TestCase
{
	public function testComputePoints(){
    $strategy = new RankingStrategySecondToThird();
    $points1 = -1;
    $points2 = -1;

    $strategy->computePoints($points1,$points2,3,0,1,1);
    $this->assertEquals(5, $points1);
    $this->assertEquals(0, $points2);

    $strategy->computePoints($points1,$points2,2,0,1,1);
    $this->assertEquals(5, $points1);
    $this->assertEquals(0, $points2);

    $strategy->computePoints($points1,$points2,2,1,1,1);
    $this->assertEquals(5, $points1);
    $this->assertEquals(1, $points2);

    $strategy->computePoints($points1,$points2,2,2,1,1);
    $this->assertEquals(3, $points1);
    $this->assertEquals(3, $points2);

    $strategy->computePoints($points1,$points2,1,1,3,0);
    $this->assertEquals(3, $points1);
    $this->assertEquals(3, $points2);

    $strategy->computePoints($points1,$points2,1,2,3,0);
    $this->assertEquals(1, $points1);
    $this->assertEquals(5, $points2);

    $strategy->computePoints($points1,$points2,1,3,3,0);
    $this->assertEquals(0, $points1);
    $this->assertEquals(5, $points2);

    $strategy->computePoints($points1,$points2,0,3,3,0);
    $this->assertEquals(0, $points1);
    $this->assertEquals(5, $points2);        
	}

	public function testComputeCoachTeamPoints(){
    $strategy = new RankingStrategySecondToThird();
    $points1 = -1;
    $points2 = -1;

    $cas1Array = array(0,0,0);
    $cas2Array = array(0,0,0);

    $tds1 = array(2,2,2);
    $tds2= array(0,0,0);		
    $strategy->computeCoachTeamPoints($points1,$points2,$tds1,$tds2,$cas1Array,$cas2Array);
    $this->assertEquals(0, $points1);
    $this->assertEquals(0, $points2);
	}
	
	public function testUseTriplettePoints(){
    $strategy = new RankingStrategySecondToThird();
    $result = $strategy->useCoachTeamPoints();
    $this->assertFalse($result);
	}
	
	public function testCompareCoach(){
    $strategy = new RankingStrategySecondToThird();
    $coach1 = new \stdClass;
    $coach2 = new \stdClass;
    $coach1->points = 0;
    $coach2->points = 0;
    $coach1->opponentsPoints = 0;
    $coach2->opponentsPoints = 0;
    $coach1->netTd = 0;
    $coach2->netTd = 0;
    $coach1->casualties = 0;
    $coach2->casualties = 0;

    $result = $strategy->compareCoachs($coach1,$coach2);
    $this->assertEquals(0,$result);

    $coach1->points = 1;
    $result = $strategy->compareCoachs($coach1,$coach2);
    $this->assertLessThan(0,$result);

    $coach2->points = 2;
    $result = $strategy->compareCoachs($coach1,$coach2);
    $this->assertGreaterThan(0,$result);

    $coach1->points = 2;
    $coach1->opponentsPoints = 1;
    $coach2->opponentsPoints = 0;
    $coach2->netTd = 1;
    $result = $strategy->compareCoachs($coach1,$coach2);
    $this->assertLessThan(0,$result);

    $coach2->opponentsPoints = 2;
    $coach1->netTd = 1;
    $result = $strategy->compareCoachs($coach1,$coach2);
    $this->assertgreaterThan(0,$result);

    $coach2->opponentsPoints = 1;
    $coach1->netTd = 2;
    $coach2->netTd = 1;
    $result = $strategy->compareCoachs($coach1,$coach2);
    $this->assertLessThan(0,$result);

    $coach1->netTd = 1;
    $coach2->netTd = 2;
    $result = $strategy->compareCoachs($coach1,$coach2);
    $this->assertGreaterThan(0,$result);

    $coach2->netTd = 1;
    $coach1->casualties = 2;
    $coach2->casualties = 1;
    $result = $strategy->compareCoachs($coach1,$coach2);
    $this->assertLessThan(0,$result);

    $coach2->casualties = 3;
    $result = $strategy->compareCoachs($coach1,$coach2);
    $this->assertGreaterThan(0,$result);
	}
  
  public function testRankingOptions(){
    $strategy = new RankingStrategySecondToThird();
    $rankings = $strategy->rankingOptions();
    $this->assertGreaterThan(0,count($rankings));
  }
}
?>