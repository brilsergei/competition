<?php

namespace App\Service\StageView;

use App\Service\StageManager\StageManagerInterface;

abstract class StageViewBase implements StageViewInterface {

  /**
   * @var \App\Service\StageManager\StageManagerInterface
   */
  protected StageManagerInterface $stageManager;

  public function __construct(StageManagerInterface $stageManager) {
    $this->stageManager = $stageManager;
  }

}