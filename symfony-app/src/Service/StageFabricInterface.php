<?php

namespace App\Service;

use App\Service\ResultGenerator\ResultGeneratorInterface;
use App\Service\StageManager\StageManagerInterface;
use App\Service\StageView\StageViewInterface;

interface StageFabricInterface {

  public function createStageManager(): StageManagerInterface;

  public function createStageView(): StageViewInterface;

  public function createStageResultsGenerator(): ResultGeneratorInterface;

}