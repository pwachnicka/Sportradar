<?php

namespace Sportradar\ScoreBoard;

use Sportradar\Exception\ScoreBoardException;
use Sportradar\Team\HomeTeam;
use Sportradar\Team\AwayTeam;

class ScoreBoard implements ScoreBoardInterface
{
    private ?HomeTeam $homeTeam;
    private ?AwayTeam $awayTeam;

    public function start(HomeTeam $homeTeam, AwayTeam $awayTeam): void
    {
        if ($this->isGameRunning() === true) {
            throw new ScoreBoardException('Function start should not be called during active game');
        }

        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->update(self::INITIAL_SCORE, self::INITIAL_SCORE);
    }

    public function update(int $homeTeamScore, int $awayTeamScore): void
    {
        if ($this->isGameRunning() === false) {
            throw new ScoreBoardException('Function update should not be called without start');
        }

        $this->homeTeam->setScore($homeTeamScore);
        $this->awayTeam->setScore($awayTeamScore);
    }

    public function finish(): void
    {
        if ($this->isGameRunning() === false) {
            throw new ScoreBoardException('Function finish should not be called without start');
        }

        $this->homeTeam = null;
        $this->awayTeam = null;
    }

    private function isGameRunning(): bool
    {
        return isset($this->homeTeam) && isset($this->awayTeam);
    }
}
