<?php

namespace App\Service\StageManager;

interface GroupStageManagerInterface extends StageManagerInterface {

  public function generateResultsMatrix(): array;

}