<?php

namespace App\Service;

use App\Repository\DivisionRepository;
use App\Repository\GameResultRepository;
use App\Repository\TeamRepository;
use App\Service\ResultGenerator\GroupResultGenerator;
use App\Service\ResultGenerator\ResultGeneratorInterface;
use App\Service\StageManager\GroupStageManager;
use App\Service\StageManager\GroupStageManagerInterface;
use App\Service\StageView\GroupStageView;
use App\Service\StageView\StageViewInterface;
use Doctrine\Persistence\ManagerRegistry;

class GroupStageFabric extends StageFabricBase {

  /**
   * @var \App\Repository\DivisionRepository
   */
  protected DivisionRepository $divisionRepository;

  public function __construct(ManagerRegistry $doctrine, GameResultRepository $repository, TeamRepository $teamRepository, DivisionRepository $divisionRepository) {
    parent::__construct($doctrine, $repository, $teamRepository);

    $this->divisionRepository = $divisionRepository;
  }

  public function createStageManager(): GroupStageManagerInterface {
    return new GroupStageManager($this->gameResultRepository, $this->teamRepository);
  }

  public function createStageView(): StageViewInterface {
    return new GroupStageView($this->createStageManager(), $this->divisionRepository, $this->teamRepository);
  }

  public function createStageResultsGenerator(): ResultGeneratorInterface {
    return new GroupResultGenerator($this->createStageManager(), $this->teamRepository, $this->doctrine, $this->divisionRepository);
  }

}