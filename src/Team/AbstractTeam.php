<?php

namespace Sportradar\Team;

abstract class AbstractTeam
{
    protected string $teamName;
    protected int $score;

    public function __construct(string $teamName)
    {
        $this->teamName = $teamName;
    }

    public function getTeamName(): string
    {
        return $this->teamName;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getScore(): int
    {
        return $this->score;
    }
}
