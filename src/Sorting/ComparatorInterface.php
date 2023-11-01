<?php

namespace Sportradar\Sorting;

use Sportradar\MatchResults;

interface ComparatorInterface
{
    public static function sortResults(MatchResults $matchResults): void;
}
