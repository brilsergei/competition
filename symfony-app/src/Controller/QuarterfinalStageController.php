<?php

namespace App\Controller;

use App\Service\QuarterfinalStageFabric;
use Symfony\Component\Routing\Annotation\Route;

class QuarterfinalStageController extends StageControllerBase {

  /**
   * @Route("/stage/quarterfinal", name="quarterfinal_stage")
   */
  public function view(QuarterfinalStageFabric $fabric) {
    return $this->generateView($fabric);
  }

  /**
   * @Route("/stage/quarterfinal/generate", name="quarterfinal_result_generate", methods={"GET"})
   */
  public function generate(QuarterfinalStageFabric $fabric) {
    $this->generateResults($fabric);

    return $this->redirectToRoute('quarterfinal_stage', [], 302);
  }

}