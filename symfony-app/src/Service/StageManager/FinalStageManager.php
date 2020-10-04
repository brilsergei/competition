<?php

namespace App\Service\StageManager;

class FinalStageManager extends PlayOffStageManagerBase {

  public function getStageName(): string {
    return 'final';
  }

}