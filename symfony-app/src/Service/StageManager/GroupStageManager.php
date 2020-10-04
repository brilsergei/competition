<?php

namespace App\Service\StageManager;

use App\Entity\GameResult;
use App\Entity\Team;

class GroupStageManager extends StageManagerBase implements GroupStageManagerInterface {

  private const NUMBER_OF_DIVISION_WINNERS = 4;

  public function findGameWinner(GameResult $gameResult): ?Team {
    if ($gameResult->getScore1() > $gameResult->getScore2()) {
      return $gameResult->getTeam1();
    }
    elseif ($gameResult->getScore1() < $gameResult->getScore2()) {
      return $gameResult->getTeam2();
    }

    return null;
  }

  public function generateResultsMatrix(): array {
    $resultsMatrix = [];
    foreach ($this->loadResults() as $result) {
      $divisionId = $result->getTeam1()->getDivision()->getId();
      $team1Id = $result->getTeam1()->getId();
      $team2Id = $result->getTeam2()->getId();
      $resultsMatrix[$divisionId][$team1Id][$team2Id] = $result;
    }

    return $resultsMatrix;
  }

  public function getStageName(): string {
    return 'group';
  }

  public function calculateTeamScores(): array {
    $teamScores = [];
    foreach ($this->loadResults() as $result) {
      $team1Id = $result->getTeam1()->getId();
      $team2Id = $result->getTeam2()->getId();
      $winner = $this->findGameWinner($result);
      $teamScores[$team1Id] = $teamScores[$team1Id] ?? 0;
      $teamScores[$team2Id] = $teamScores[$team2Id] ?? 0;
      if ($winner instanceof Team) {
        $teamScores[$team1Id] += $winner->getId() == $team1Id ? 1 : 0;
        $teamScores[$team2Id] += $winner->getId() == $team2Id ? 1 : 0;
      }
    }

    return $teamScores;
  }

  public function findStageWinners(): array {
    $groupedScores = [];
    $teamScores = $this->calculateTeamScores();
    foreach ($this->teamRepository->findAll() as $team) {
      $groupedScores[$team->getDivision()->getId()][$team->getId()] = $teamScores[$team->getId()] ?? 0;
    }

    $groupWinners = [];
    foreach ($groupedScores as $divisionId => $divisionScores) {
      $divisionWinners = [];
      do {
        $max = max($divisionScores);
        $ids = array_keys($divisionScores, $max);
        if (count($divisionWinners) + count($ids) > static::NUMBER_OF_DIVISION_WINNERS) {
          $ids = array_slice($ids, 0, static::NUMBER_OF_DIVISION_WINNERS - count($divisionWinners));
        }
        $divisionWinners += array_fill_keys($ids, $max);
        $divisionScores = array_diff_key($divisionScores, array_fill_keys($ids, $max));
      }
      while (count($divisionWinners) < static::NUMBER_OF_DIVISION_WINNERS);

      $groupWinners[] = $divisionWinners;
    }

    return $groupWinners;
  }

}