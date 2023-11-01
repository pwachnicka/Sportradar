<?php

namespace Sportradar;

use ArrayObject;
use Sportradar\Team\AwayTeam;
use Sportradar\Team\HomeTeam;

class MatchResults extends ArrayObject
{
    public function save(HomeTeam $homeTeam, AwayTeam $awayTeam): void
    {
        $this->append([$homeTeam, $awayTeam]);
    }

    public function getSummary(): array
    {
        $summary = [];

        foreach ($this as $singleResult) {
            $summary[] = [
                $singleResult[0]->getTeamName() => $singleResult[0]->getScore(),
                $singleResult[1]->getTeamName() => $singleResult[1]->getScore(),
            ];
        }

        return $summary;
    }
}
