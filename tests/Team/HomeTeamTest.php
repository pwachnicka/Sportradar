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

    public function test_should_return_correct_score_when_numeric_score_is_provided()
    {
        $expectedScore = 5;
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
        $firstScore = 3;
        $nextScore = 2;

        $homeTeam = new HomeTeam('TestTeam');
        $homeTeam->setScore($firstScore);
        $this->expectException(ScoreException::class);
        $this->expectExceptionMessage('Score should not be less than previous one');
        $homeTeam->setScore($nextScore);
    }
}
