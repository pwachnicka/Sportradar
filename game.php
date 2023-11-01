<?php
require __DIR__ . '/vendor/autoload.php';

use Sportradar\MatchResults;
use Sportradar\ScoreBoard\ScoreBoard;
use Sportradar\Sorting\ReverseOrderWithLIFOComparator;
use Sportradar\Team\AwayTeam;
use Sportradar\Team\HomeTeam;

$sourceData = require_once('data/sourceData.php');

$matchResults = new MatchResults();
$scoreBoard = new ScoreBoard();

foreach ($sourceData as $match) {

    $homeTeam = new HomeTeam($match['teams']['home']);
    $awayTeam = new AwayTeam($match['teams']['away']);

    $scoreBoard->start($homeTeam, $awayTeam);

    foreach ($match['score'] as $score) {
        $scoreBoard->update($score['home'], $score['away']);
    }

    $scoreBoard->finish();
    $matchResults->save($homeTeam, $awayTeam);
}
ReverseOrderWithLIFOComparator::sortResults($matchResults);
print_r($matchResults->getSummary());
