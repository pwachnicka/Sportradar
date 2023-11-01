<?php

namespace SportradarTest;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sportradar\MatchResults;
use Sportradar\Team\AwayTeam;
use Sportradar\Team\HomeTeam;

class MatchResultsTest extends TestCase
{
    public function test_should_return_summary_when_single_match_is_provided()
    {
        /** @var HomeTeam&MockObject $homeTeamMock */
        $homeTeamMock = $this->createMock(HomeTeam::class);
        $homeTeamMock
            ->method('getTeamName')
            ->willReturn('Poland');
        $homeTeamMock
            ->method('getScore')
            ->willReturn(10);

        /** @var AwayTeam&MockObject $awayTeamMock */
        $awayTeamMock = $this->createMock(AwayTeam::class);
        $awayTeamMock
            ->method('getTeamName')
            ->willReturn('Germany');
        $awayTeamMock
            ->method('getScore')
            ->willReturn(0);

        $matchResults = new MatchResults();
        $matchResults->save($homeTeamMock, $awayTeamMock);

        $this->assertEquals([[
            'Poland' => 10,
            'Germany' => 0,
        ]], $matchResults->getSummary());
    }

    public function test_should_return_summary_when_two_matches_are_provided()
    {
        /** @var HomeTeam&MockObject $homeTeamMockMatch1 */
        $homeTeamMockMatch1 = $this->createMock(HomeTeam::class);
        $homeTeamMockMatch1
            ->method('getTeamName')
            ->willReturn('Mexico');
        $homeTeamMockMatch1
            ->method('getScore')
            ->willReturn(2);

        /** @var AwayTeam&MockObject $awayTeamMockMatch1 */
        $awayTeamMockMatch1 = $this->createMock(AwayTeam::class);
        $awayTeamMockMatch1
            ->method('getTeamName')
            ->willReturn('Germany');
        $awayTeamMockMatch1
            ->method('getScore')
            ->willReturn(0);

        /** @var HomeTeam&MockObject $homeTeamMockMatch2 */
        $homeTeamMockMatch2 = $this->createMock(HomeTeam::class);
        $homeTeamMockMatch2
            ->method('getTeamName')
            ->willReturn('Italy');
        $homeTeamMockMatch2
            ->method('getScore')
            ->willReturn(3);

        /** @var AwayTeam&MockObject $awayTeamMockMatch2 */
        $awayTeamMockMatch2 = $this->createMock(AwayTeam::class);
        $awayTeamMockMatch2
            ->method('getTeamName')
            ->willReturn('France');
        $awayTeamMockMatch2
            ->method('getScore')
            ->willReturn(5);

        $matchResults = new MatchResults();
        $matchResults->save($homeTeamMockMatch1, $awayTeamMockMatch1);
        $matchResults->save($homeTeamMockMatch2, $awayTeamMockMatch2);

        $this->assertEquals([
            [
                'Mexico' => 2,
                'Germany' => 0,
            ],
            [
                'Italy' => 3,
                'France' => 5,
            ]
        ], $matchResults->getSummary());
    }
}
