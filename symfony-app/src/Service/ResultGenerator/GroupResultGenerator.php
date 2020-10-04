<?php

namespace App\Service\ResultGenerator;

use App\Entity\GameResult;
use App\Repository\DivisionRepository;
use App\Repository\TeamRepository;
use App\Service\StageManager\GroupStageManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class GroupResultGenerator extends ResultGeneratorBase {

  /**
   * @var \App\Repository\DivisionRepository
   */
  protected DivisionRepository $divisionRepository;

  public function __construct(GroupStageManagerInterface $stageManager, TeamRepository $teamRepository, ManagerRegistry $doctrine, DivisionRepository $divisionRepository) {
    parent::__construct($stageManager, $teamRepository, $doctrine);

    $this->divisionRepository = $divisionRepository;
  }

  public function generateResults(): void {
    $resultsMatrix = $this->stageManager->generateResultsMatrix();
    $teams = $this->teamRepository->findAll();

    foreach ($this->divisionRepository->findAll() as $division) {
      foreach ($teams as $team1) {
        foreach ($teams as $team2) {
          if ($team1->getDivision()->getId() == $division->getId() && $team2->getDivision()->getId() == $division->getId()) {
            $hasResult = isset($resultsMatrix[$division->getId()][$team1->getId()][$team2->getId()])
              || isset($resultsMatrix[$division->getId()][$team2->getId()][$team1->getId()]);
            $sameTeam = $team1->getId() == $team2->getId();
            if (!$hasResult && !$sameTeam) {
              $result = new GameResult();
              $result->setTeam1($team1)
                ->setTeam2($team2)
                ->setScore1(rand(0, 10))
                ->setScore2(rand(0, 10))
                ->setStage($this->stageManager->getStageName());
              $this->entityManager->persist($result);
              $resultsMatrix[$division->getId()][$team1->getId()][$team2->getId()] = $result;
            }
          }
        }
      }
    }

    $this->entityManager->flush();
  }

}