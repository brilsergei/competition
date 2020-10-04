<?php

namespace App\Service\StageManager;

use App\Repository\GameResultRepository;
use App\Repository\TeamRepository;

abstract class StageManagerBase implements StageManagerInterface {

  /**
   * @var \App\Repository\GameResultRepository
   */
  protected GameResultRepository $gameResultRepository;

  /**
   * @var \App\Repository\GameResultRepository
   */
  protected $teamRepository;

  public function __construct(GameResultRepository $gameResultRepository, TeamRepository $teamRepository) {
    $this->gameResultRepository = $gameResultRepository;
    $this->teamRepository = $teamRepository;
  }

  public function loadResults(): array {
    return $this->gameResultRepository->findByStageField($this->getStageName());
  }

}