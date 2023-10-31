<?php

namespace Sportradar;

use Sportradar\Exception\ScoreBoardException;
use Sportradar\Exception\ScoreException;
use Sportradar\Team\HomeTeam;
use Sportradar\Team\AwayTeam;

class ScoreBoard
{
    private const INITIAL_SCORE = 0;
    private ?HomeTeam $homeTeam;
    private ?AwayTeam $awayTeam;

    public function start(HomeTeam $homeTeam, AwayTeam $awayTeam): void
    {
        if (isset($this->homeTeam) === true && isset($this->awayTeam) === true) {
            throw new ScoreBoardException('Function start should not be called during active game');
        }

        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->update(self::INITIAL_SCORE, self::INITIAL_SCORE);
    }

    public function update(int $homeTeamScore, int $awayTeamScore): void
    {
        if (isset($this->homeTeam) === false && isset($this->awayTeam) === false) {
            throw new ScoreBoardException('Function update should not be called without start');
        }

        $this->homeTeam->setScore($homeTeamScore);
        $this->awayTeam->setScore($awayTeamScore);
    }

    public function finish(): void
    {
        // this function will finish the game and clear the scoreboard
    }
}
