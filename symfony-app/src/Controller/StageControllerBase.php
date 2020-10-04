<?php

namespace App\Controller;

use App\Service\StageFabricInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class StageControllerBase extends AbstractController {

  protected function generateView(StageFabricInterface $fabric): Response {
    $view = $fabric->createStageView();
    $variables = $view->prepareVariablesForTemplate();
    return $this->render($view->getTemplatePath(), $variables);
  }

  protected function generateResults(StageFabricInterface $fabric): void {
    $generator = $fabric->createStageResultsGenerator();
    $generator->generateResults();
  }

}