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
        $this->uksort(function ($matchKey1, $matchKey2) {
            $sumMatch1 = $this[$matchKey1][0]->getScore() + $this[$matchKey1][1]->getScore();
            $sumMatch2 = $this[$matchKey2][0]->getScore() + $this[$matchKey2][1]->getScore();

            if ($sumMatch1 === $sumMatch2) {
                return $matchKey1 > $matchKey2 ? -1 : 1;
            }

            return $sumMatch1 > $sumMatch2 ? -1 : 1;
        });

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
