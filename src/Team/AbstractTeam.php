<?php

namespace Sportradar\Team;

use Sportradar\Exception\ScoreException;

abstract class AbstractTeam
{
    protected string $teamName;
    protected ?int $score = null;

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
        if ($score < 0) {
            throw new ScoreException('Score should not be negative');
        }

        if ($score < $this->score) {
            throw new ScoreException('Score should not be less than previous one');
        }

        if (($score - $this->score) > 1) {
            throw new ScoreException('Score should not be greater by more than one than previous score');
        }

        $this->score = $score;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }
}
