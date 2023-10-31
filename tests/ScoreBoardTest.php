<?php

namespace SportradarTest;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SEEC\PhpUnit\Helper\ConsecutiveParams;
use Sportradar\Exception\ScoreBoardException;
use Sportradar\ScoreBoard;
use Sportradar\Team\AwayTeam;
use Sportradar\Team\HomeTeam;

class ScoreBoardTest extends TestCase
{
    use ConsecutiveParams;
    public function test_should_initialize_0_0_score_when_teams_are_provided()
    {
        /** @var HomeTeam&MockObject $homeTeamMock  */
        $homeTeamMock = $this->createMock(HomeTeam::class);
        $homeTeamMock
            ->expects($this->once())
            ->method('setScore')
            ->with($this->equalTo(0));

        /** @var AwayTeam&MockObject $awayTeamMock  */
        $awayTeamMock = $this->createMock(AwayTeam::class);
        $awayTeamMock
            ->expects($this->once())
            ->method('setScore')
            ->with($this->equalTo(0));

        $scoreBoard = new ScoreBoard();
        $scoreBoard->start($homeTeamMock, $awayTeamMock);
    }

    public function test_should_throw_exception_when_start_is_called_during_active_game()
    {
        /** @var HomeTeam&MockObject $homeTeamMock  */
        $homeTeamMock = $this->createMock(HomeTeam::class);
        $homeTeamMock
            ->expects($this->once())
            ->method('setScore')
            ->with($this->equalTo(0));

        /** @var AwayTeam&MockObject $awayTeamMock  */
        $awayTeamMock = $this->createMock(AwayTeam::class);
        $awayTeamMock
            ->expects($this->once())
            ->method('setScore')
            ->with($this->equalTo(0));

        $scoreBoard = new ScoreBoard();
        $scoreBoard->start($homeTeamMock, $awayTeamMock);
        $this->expectException(ScoreBoardException::class);
        $this->expectExceptionMessage('Function start should not be called during active game');
        $scoreBoard->start($homeTeamMock, $awayTeamMock);
    }

    public function test_should_set_teams_score_when_scores_are_provided()
    {
        $homeTeamScore = 1;
        $awayTeamScore = 0;

        /** @var HomeTeam&MockObject $homeTeamMock  */
        $homeTeamMock = $this->createMock(HomeTeam::class);
        $homeTeamMock
            ->expects($this->exactly(2))
            ->method('setScore')
            ->with(...$this->withConsecutive(
                [$this->equalTo(0)],
                [$this->equalTo($homeTeamScore)]
            ));

        /** @var AwayTeam&MockObject $awayTeamMock  */
        $awayTeamMock = $this->createMock(AwayTeam::class);
        $awayTeamMock
            ->expects($this->exactly(2))
            ->method('setScore')
            ->with(...$this->withConsecutive(
                [$this->equalTo(0)],
                [$this->equalTo($awayTeamScore)]
            ));

        $scoreBoard = new ScoreBoard();
        $scoreBoard->start($homeTeamMock, $awayTeamMock);
        $scoreBoard->update($homeTeamScore, $awayTeamScore);
    }

    public function test_should_throw_exception_when_update_is_called_without_start()
    {
        $homeTeamScore = 1;
        $awayTeamScore = 0;

        /** @var HomeTeam&MockObject $homeTeamMock  */
        $homeTeamMock = $this->createMock(HomeTeam::class);
        $homeTeamMock
            ->expects($this->once())
            ->method('setScore')
            ->with($this->equalTo(0));

        /** @var AwayTeam&MockObject $awayTeamMock  */
        $awayTeamMock = $this->createMock(AwayTeam::class);
        $awayTeamMock
            ->expects($this->once())
            ->method('setScore')
            ->with($this->equalTo(0));

        $scoreBoard = new ScoreBoard();
        $this->expectException(ScoreBoardException::class);
        $this->expectExceptionMessage('Function update should not be called without start');
        $scoreBoard->update($homeTeamScore, $awayTeamScore);
    }
}
