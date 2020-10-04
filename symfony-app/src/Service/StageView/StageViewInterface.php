<?php

namespace App\Service\StageView;

interface StageViewInterface {

  /**
   * @return array
   */
  public function prepareVariablesForTemplate(): array;

  public function getTemplatePath(): string;

}