<?php

namespace SportradarTest\Team;

use PHPUnit\Framework\TestCase;
use Sportradar\Exception\ScoreException;
use Sportradar\Team\HomeTeam;

class HomeTeamTest extends TestCase
{
    public function test_should_return_team_name_when_provided_to_the_constructor()
    {
        $expectedTeamName = 'Poland';
        $homeTeam = new HomeTeam($expectedTeamName);

        $this->assertEquals($expectedTeamName, $homeTeam->getTeamName());
    }

    public function test_should_return_null_when_score_is_not_provided()
    {
        $homeTeam = new HomeTeam('TestTeam');

        $this->assertNull($homeTeam->getScore());
    }

    public function test_should_return_correct_score_when_numeric_score_is_provided()
    {
        $expectedScore = 1;
        $homeTeam = new HomeTeam('TestTeam');
        $homeTeam->setScore($expectedScore);

        $this->assertEquals($expectedScore, $homeTeam->getScore());
    }

    public function test_should_throw_exception_when_provided_score_is_negative()
    {
        $wrongScore = -5;

        $homeTeam = new HomeTeam('TestTeam');
        $this->expectException(ScoreException::class);
        $this->expectExceptionMessage('Score should not be negative');
        $homeTeam->setScore($wrongScore);
    }

    public function test_should_throw_exception_when_provided_score_is_less_than_previous_one()
    {
        $firstScore = 1;
        $nextScore = 0;

        $homeTeam = new HomeTeam('TestTeam');
        $homeTeam->setScore($firstScore);
        $this->expectException(ScoreException::class);
        $this->expectExceptionMessage('Score should not be less than previous one');
        $homeTeam->setScore($nextScore);
    }

    public function test_should_throw_exception_when_provided_score_is_greater_by_more_than_one_than_previous_one()
    {
        $firstScore = 1;
        $nextScore = 3;

        $homeTeam = new HomeTeam('TestTeam');
        $homeTeam->setScore($firstScore);
        $this->expectException(ScoreException::class);
        $this->expectExceptionMessage('Score should not be greater by more than one than previous score');
        $homeTeam->setScore($nextScore);
    }
}
