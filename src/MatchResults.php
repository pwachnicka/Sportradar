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

        $this->sortResults();

        foreach ($this as $singleResult) {
            $summary[] = [
                $singleResult[0]->getTeamName() => $singleResult[0]->getScore(),
                $singleResult[1]->getTeamName() => $singleResult[1]->getScore(),
            ];
        }

        return $summary;
    }

    private function sortResults(): void
    {
        $this->uksort(function ($matchKey1, $matchKey2) {
            $match1 = $this[$matchKey1];
            $match2 = $this[$matchKey2];

            $sumResultMatch1 = $match1[0]->getScore() + $match1[1]->getScore();
            $sumResultMatch2 = $match2[0]->getScore() + $match2[1]->getScore();

            if ($sumResultMatch1 === $sumResultMatch2) {
                return $matchKey1 > $matchKey2 ? -1 : 1;
            }

            return $sumResultMatch1 > $sumResultMatch2 ? -1 : 1;
        });
    }
}
