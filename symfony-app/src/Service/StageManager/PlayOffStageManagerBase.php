<?php

namespace App\Service\StageManager;

use App\Entity\GameResult;
use App\Entity\Team;

abstract class PlayOffStageManagerBase extends StageManagerBase {

  public function findGameWinner(GameResult $gameResult): ?Team {
    $teams[1] = $gameResult->getTeam1();
    $teams[2] = $gameResult->getTeam2();
    if ($gameResult->getScore1() > $gameResult->getScore2()) {
      $winner = 1;
    }
    elseif ($gameResult->getScore1() < $gameResult->getScore2()) {
      $winner = 2;
    }
    else {
      $winner = rand(1, 2);
    }

    return $teams[$winner];
  }

  /**
   * @inheritDoc
   */
  public function calculateTeamScores(): array {
    $teamScores = [];
    foreach ($this->loadResults() as $result) {
      $winner = $this->findGameWinner($result);
      $teamScores[$result->getTeam1()->getId()] = (int) $winner->getId() == $result->getTeam1()->getId();
      $teamScores[$result->getTeam2()->getId()] = (int) $winner->getId() == $result->getTeam2()->getId();
    }

    return $teamScores;
  }

  public function findStageWinners(): array {
    return array_filter($this->calculateTeamScores());
  }

}