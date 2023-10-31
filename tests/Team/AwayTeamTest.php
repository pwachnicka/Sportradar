<?php

namespace SportradarTest\Team;

use PHPUnit\Framework\TestCase;
use Sportradar\Exception\ScoreException;
use Sportradar\Team\AwayTeam;

class AwayTeamTest extends TestCase
{
    public function test_should_return_team_name_when_provided_to_the_constructor()
    {
        $expectedTeamName = 'Poland';
        $awayTeam = new AwayTeam($expectedTeamName);

        $this->assertEquals($expectedTeamName, $awayTeam->getTeamName());
    }

    public function test_should_return_null_when_score_is_not_provided()
    {
        $awayTeam = new AwayTeam('TestTeam');

        $this->assertNull($awayTeam->getScore());
    }

    public function test_should_return_correct_score_when_numeric_score_is_provided()
    {
        $expectedScore = 1;
        $awayTeam = new AwayTeam('TestTeam');
        $awayTeam->setScore($expectedScore);

        $this->assertEquals($expectedScore, $awayTeam->getScore());
    }

    public function test_should_throw_exception_when_provided_score_is_negative()
    {
        $wrongScore = -5;

        $awayTeam = new AwayTeam('TestTeam');
        $this->expectException(ScoreException::class);
        $this->expectExceptionMessage('Score should not be negative');
        $awayTeam->setScore($wrongScore);
    }

    public function test_should_throw_exception_when_provided_score_is_less_than_previous_one()
    {
        $firstScore = 1;
        $nextScore = 0;

        $awayTeam = new AwayTeam('TestTeam');
        $awayTeam->setScore($firstScore);
        $this->expectException(ScoreException::class);
        $this->expectExceptionMessage('Score should not be less than previous one');
        $awayTeam->setScore($nextScore);
    }

    public function test_should_throw_exception_when_provided_score_is_greater_by_more_than_one_than_previous_one()
    {
        $firstScore = 1;
        $nextScore = 3;

        $awayTeam = new AwayTeam('TestTeam');
        $awayTeam->setScore($firstScore);
        $this->expectException(ScoreException::class);
        $this->expectExceptionMessage('Score should not be greater by more than one than previous score');
        $awayTeam->setScore($nextScore);
    }
}
