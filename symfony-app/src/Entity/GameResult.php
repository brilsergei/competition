<?php

namespace App\Entity;

use App\Repository\GameResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameResultRepository::class)
 */
class GameResult
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_1;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $team_2;

    /**
     * @ORM\Column(type="integer")
     */
    private $score_1;

    /**
     * @ORM\Column(type="integer")
     */
    private $score_2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeam1(): ?Team
    {
        return $this->team_1;
    }

    public function setTeam1(?Team $team_1): self
    {
        $this->team_1 = $team_1;

        return $this;
    }

    public function getTeam2(): ?Team
    {
        return $this->team_2;
    }

    public function setTeam2(?Team $team_2): self
    {
        $this->team_2 = $team_2;

        return $this;
    }

    public function getScore1(): ?int
    {
        return $this->score_1;
    }

    public function setScore1(int $score_1): self
    {
        $this->score_1 = $score_1;

        return $this;
    }

    public function getScore2(): ?int
    {
        return $this->score_2;
    }

    public function setScore2(int $score_2): self
    {
        $this->score_2 = $score_2;

        return $this;
    }

    public function getStage(): ?string
    {
        return $this->stage;
    }

    public function setStage(string $stage): self
    {
        $this->stage = $stage;

        return $this;
    }
}
