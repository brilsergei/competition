<?php

namespace App\Service\ResultGenerator;

class QuarterfinalResultGenerator extends PlayOffStageResultGenerator {

  public function generateResults(): void {
    $results = $this->stageManager->loadResults();
    $resultMatrix = [];
    foreach ($results as $result) {
      $resultMatrix[$result->getTeam1()->getId()][$result->getTeam2()->getId()] = $result;
    }
    [$division1, $division2] = $this->previousStageManager->findStageWinners();
    while (!empty($division1) && !empty($division2)) {
      $team1Id = array_search(max($division1), $division1);
      $team2Id = array_search(min($division2), $division2);
      $this->createResult($team1Id, $team2Id, $resultMatrix);
      unset($division1[$team1Id], $division2[$team2Id]);
    }

    $this->entityManager->flush();
  }

}