<?php

namespace Sportradar\Sorting;

use Sportradar\MatchResults;

class ReverseOrderWithLIFOComparator implements ComparatorInterface
{
    public static function sortResults(MatchResults $matchResults): void
    {
        $matchResults->uksort(function ($matchKey1, $matchKey2) use ($matchResults) {
            $match1 = $matchResults[$matchKey1];
            $match2 = $matchResults[$matchKey2];

            $sumResultMatch1 = $match1[0]->getScore() + $match1[1]->getScore();
            $sumResultMatch2 = $match2[0]->getScore() + $match2[1]->getScore();

            if ($sumResultMatch1 === $sumResultMatch2) {
                return $matchKey1 > $matchKey2 ? -1 : 1;
            }

            return $sumResultMatch1 > $sumResultMatch2 ? -1 : 1;
        });
    }
}
