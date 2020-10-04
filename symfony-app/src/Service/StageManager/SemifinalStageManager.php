<?php

namespace App\Service\StageManager;

use App\Entity\GameResult;
use App\Entity\Team;

class SemifinalStageManager extends PlayOffStageManagerBase {

  public function getStageName(): string {
    return 'semifinal';
  }

}