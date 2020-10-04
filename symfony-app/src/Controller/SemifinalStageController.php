<?php

namespace App\Controller;

use App\Service\QuarterfinalStageFabric;
use App\Service\SemifinalStageFabric;
use Symfony\Component\Routing\Annotation\Route;

class SemifinalStageController extends StageControllerBase {

  /**
   * @Route("/stage/semifinal", name="semifinal_stage")
   */
  public function view(SemifinalStageFabric $fabric) {
    return $this->generateView($fabric);
  }

  /**
   * @Route("/stage/semifinal/generate", name="semifinal_result_generate", methods={"GET"})
   */
  public function generate(SemifinalStageFabric $fabric) {
    $this->generateResults($fabric);

    return $this->redirectToRoute('semifinal_stage', [], 302);
  }

}