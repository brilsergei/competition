<?php

namespace App\Service\ResultGenerator;

use App\Service\StageManager\StageManagerInterface;

interface PlayOffStageResultGeneratorInterface extends ResultGeneratorInterface {

  public function setPreviousStageManager(StageManagerInterface $stageManager): self;

}