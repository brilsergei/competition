<?php

namespace App\Controller;

use App\Service\FinalStageFabric;
use Symfony\Component\Routing\Annotation\Route;

class FinalStageController extends StageControllerBase {

  /**
   * @Route("/stage/final", name="final_stage")
   */
  public function view(FinalStageFabric $fabric) {
    return $this->generateView($fabric);
  }

  /**
   * @Route("/stage/final/generate", name="final_result_generate", methods={"GET"})
   */
  public function generate(FinalStageFabric $fabric) {
    $this->generateResults($fabric);

    return $this->redirectToRoute('final_stage', [], 302);
  }

}