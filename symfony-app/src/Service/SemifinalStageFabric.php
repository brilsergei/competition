<?php

namespace App\Service;

use App\Repository\GameResultRepository;
use App\Repository\TeamRepository;
use App\Service\ResultGenerator\PlayOffStageResultGenerator;
use App\Service\ResultGenerator\ResultGeneratorInterface;
use App\Service\StageManager\SemifinalStageManager;
use App\Service\StageManager\StageManagerInterface;
use App\Service\StageView\SemifinalStageView;
use App\Service\StageView\StageViewInterface;
use Doctrine\Persistence\ManagerRegistry;

class SemifinalStageFabric extends StageFabricBase {

  /**
   * @var \App\Service\GroupStageFabric
   */
  protected $previousStageFabric;

  public function __construct(ManagerRegistry $doctrine, GameResultRepository $gameResultRepository, TeamRepository $teamRepository, QuarterfinalStageFabric $fabric) {
    parent::__construct($doctrine, $gameResultRepository, $teamRepository);

    $this->previousStageFabric = $fabric;
  }

  public function createStageManager(): StageManagerInterface {
    return new SemifinalStageManager($this->gameResultRepository, $this->teamRepository);
  }

  public function createStageView(): StageViewInterface {
    return new SemifinalStageView($this->createStageManager());
  }

  public function createStageResultsGenerator(): ResultGeneratorInterface {
    $generator = new PlayOffStageResultGenerator($this->createStageManager(), $this->teamRepository, $this->doctrine);
    $generator->setPreviousStageManager($this->previousStageFabric->createStageManager());
    return $generator;
  }

}