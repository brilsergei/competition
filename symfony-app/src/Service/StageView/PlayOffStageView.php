<?php

namespace App\Service\StageView;

abstract class PlayOffStageView extends StageViewBase {

  /**
   * @inheritDoc
   */
  public function prepareVariablesForTemplate(): array {
    return [
      'title' => $this->title(),
      'results' => $this->stageManager->loadResults(),
    ];
  }

  public function getTemplatePath(): string {
    return 'stage/play_off.html.twig';
  }

  abstract protected function title(): string;

}