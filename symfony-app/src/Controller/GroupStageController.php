<?php

namespace App\Controller;

use App\Service\GroupStageFabric;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class GroupStageController extends StageControllerBase {

  /**
   * @Route("/stage/group", name="group_stage")
   *
   * @param \App\Service\GroupStageFabric $fabric
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function view(GroupStageFabric $fabric) {
    return $this->generateView($fabric);
  }

  /**
   * @Route("/stage/group/generate", name="group_result_generate")
   */
  public function generate(GroupStageFabric $fabric) {
    $this->generateResults($fabric);

    return $this->redirectToRoute('group_stage', [], 302);
  }

}