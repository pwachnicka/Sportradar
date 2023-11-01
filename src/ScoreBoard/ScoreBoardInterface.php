<?php

namespace Sportradar\ScoreBoard;

use Sportradar\Team\AwayTeam;
use Sportradar\Team\HomeTeam;

interface ScoreBoardInterface
{
    const INITIAL_SCORE = 0;

    public function start(HomeTeam $homeTeam, AwayTeam $awayTeam): void;

    public function update(int $homeTeamScore, int $awayTeamScore): void;

    public function finish(): void;
}
