<?php

namespace App\Service\ResultGenerator;

use App\Entity\GameResult;
use App\Service\StageManager\StageManagerInterface;

class PlayOffStageResultGenerator extends ResultGeneratorBase implements PlayOffStageResultGeneratorInterface {

  /**
   * @var \App\Service\StageManager\StageManagerInterface
   */
  protected StageManagerInterface $previousStageManager;

  public function setPreviousStageManager(StageManagerInterface $stageManager): self {
    $this->previousStageManager = $stageManager;
    return $this;
  }

  public function generateResults(): void {
    $results = $this->stageManager->loadResults();
    $resultMatrix = [];
    foreach ($results as $result) {
      $resultMatrix[$result->getTeam1()->getId()][$result->getTeam2()->getId()] = $result;
    }
    $winners = $this->previousStageManager->findStageWinners();
    while (!empty($winners)) {
      $team1Id = key($winners);
      unset($winners[$team1Id]);
      $team2Id = key($winners);
      unset($winners[$team2Id]);
      $this->createResult($team1Id, $team2Id, $resultMatrix);
    }

    $this->entityManager->flush();
  }

  protected function createResult($team1Id, $team2Id, &$resultMatrix) {
    $hasResult = isset($resultMatrix[$team1Id][$team2Id]) || isset($resultMatrix[$team2Id][$team1Id]);
    if (!$hasResult) {
      $team1 = $this->teamRepository->find($team1Id);
      $team2 = $this->teamRepository->find($team2Id);
      $result = new GameResult();
      $result->setTeam1($team1)
        ->setTeam2($team2)
        ->setScore1(rand(0, 10))
        ->setScore2(rand(0, 10))
        ->setStage($this->stageManager->getStageName());
      $this->entityManager->persist($result);
      $resultMatrix[$team1->getId()][$team2->getId()] = $result;
    }
  }

}