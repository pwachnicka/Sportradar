<?php

namespace SportradarTest;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sportradar\MatchResults;
use Sportradar\Team\AwayTeam;
use Sportradar\Team\HomeTeam;

class MatchResultsTest extends TestCase
{
    public static function matchResultsProvider(): array
    {
        return [
            'two elements' => [
                'result' => [
                    [
                        'Mexico' => 0,
                        'Canada' => 5,
                    ],
                    [
                        'Spain' => 10,
                        'Brazil' => 2,
                    ]
                ],
                'expected' => [
                    [
                        'Spain' => 10,
                        'Brazil' => 2,
                    ],
                    [
                        'Mexico' => 0,
                        'Canada' => 5,
                    ]
                ]

            ],
            'two elements with the same results' => [
                'result' => [
                    [
                        'Mexico' => 0,
                        'Canada' => 5,
                    ],
                    [
                        'Spain' => 0,
                        'Brazil' => 5,
                    ]
                ],
                'expected' => [
                    [
                        'Spain' => 0,
                        'Brazil' => 5,
                    ],
                    [
                        'Mexico' => 0,
                        'Canada' => 5,
                    ]
                ]

            ],
            'three elements with different results' => [
                'result' => [
                    [
                        'Mexico' => 0,
                        'Canada' => 5,
                    ],
                    [
                        'Spain' => 10,
                        'Brazil' => 2,
                    ],
                    [
                        'Poland' => 7,
                        'Germany' => 0,
                    ]
                ],
                'expected' => [
                    [
                        'Spain' => 10,
                        'Brazil' => 2,
                    ],
                    [
                        'Poland' => 7,
                        'Germany' => 0,
                    ],
                    [
                        'Mexico' => 0,
                        'Canada' => 5,
                    ]
                ]

            ],
            'three elements with the same results' => [
                'result' => [
                    [
                        'Mexico' => 2,
                        'Canada' => 2,
                    ],
                    [
                        'Spain' => 2,
                        'Brazil' => 2,
                    ],
                    [
                        'Poland' => 2,
                        'Germany' => 2,
                    ]
                ],
                'expected' => [
                    [
                        'Poland' => 2,
                        'Germany' => 2,
                    ],
                    [
                        'Spain' => 2,
                        'Brazil' => 2,
                    ],
                    [
                        'Mexico' => 2,
                        'Canada' => 2,
                    ]
                ]

            ]
        ];
    }

    #[DataProvider('matchResultsProvider')]
    public function test_should_get_sorted_summary_when_array_provided($matchResultsArray, $expected)
    {
        $matchResults = new MatchResults();

        foreach ($matchResultsArray as $result) {
            $homeTeamName = array_key_first($result);

            /** @var HomeTeam&MockObject $homeTeamMock */
            $homeTeamMock = $this->createMock(HomeTeam::class);
            $homeTeamMock
                ->method('getTeamName')
                ->willReturn($homeTeamName);
            $homeTeamMock
                ->method('getScore')
                ->willReturn($result[$homeTeamName]);

            $awayTeamName = array_key_last($result);

            /** @var AwayTeam&MockObject $awayTeamMock */
            $awayTeamMock = $this->createMock(AwayTeam::class);
            $awayTeamMock
                ->method('getTeamName')
                ->willReturn($awayTeamName);
            $awayTeamMock
                ->method('getScore')
                ->willReturn($result[$awayTeamName]);


            $matchResults->save($homeTeamMock, $awayTeamMock);
        }

        $this->assertEquals($expected, $matchResults->getSummary());
    }
}
