<?php


namespace App\Service;


use App\Repository\GameResultRepository;
use App\Repository\TeamRepository;
use App\Service\ResultGenerator\GroupResultGenerator;
use App\Service\ResultGenerator\QuarterfinalResultGenerator;
use App\Service\ResultGenerator\ResultGeneratorInterface;
use App\Service\StageManager\QuarterfinalStageManager;
use App\Service\StageManager\StageManagerInterface;
use App\Service\StageView\QuarterfinalStageView;
use App\Service\StageView\StageViewInterface;
use Doctrine\Persistence\ManagerRegistry;

class QuarterfinalStageFabric extends StageFabricBase {

  /**
   * @var \App\Service\GroupStageFabric
   */
  protected GroupStageFabric $previousStageFabric;

  public function __construct(ManagerRegistry $doctrine, GameResultRepository $gameResultRepository, TeamRepository $teamRepository, GroupStageFabric $fabric) {
    parent::__construct($doctrine, $gameResultRepository, $teamRepository);

    $this->previousStageFabric = $fabric;
  }

  public function createStageManager(): StageManagerInterface {
    return new QuarterfinalStageManager($this->gameResultRepository, $this->teamRepository);
  }

  public function createStageView(): StageViewInterface {
    return new QuarterfinalStageView($this->createStageManager());
  }

  public function createStageResultsGenerator(): ResultGeneratorInterface {
    $generator = new QuarterfinalResultGenerator($this->createStageManager(), $this->teamRepository, $this->doctrine);
    $generator->setPreviousStageManager($this->previousStageFabric->createStageManager());
    return $generator;
  }

}