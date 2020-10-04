<?php

namespace App\Service\StageManager;

use App\Entity\GameResult;
use App\Entity\Team;

interface StageManagerInterface {

  /**
   * @return \App\Entity\GameResult[]
   */
  public function loadResults(): array;

  public function findGameWinner(GameResult $gameResult): ?Team;

  public function getStageName(): string;

  /**
   * @return int[]
   */
  public function calculateTeamScores(): array;

  public function findStageWinners(): array;

}