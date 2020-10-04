<?php

namespace App\Service\ResultGenerator;

use App\Repository\TeamRepository;
use App\Service\StageManager\StageManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

abstract class ResultGeneratorBase implements ResultGeneratorInterface {

  /**
   * @var \App\Service\StageManager\StageManagerInterface
   */
  protected StageManagerInterface $stageManager;

  /**
   * @var \App\Repository\TeamRepository
   */
  protected TeamRepository $teamRepository;

  /**
   * @var \Doctrine\Persistence\ObjectManager
   */
  protected ObjectManager $entityManager;

  public function __construct(StageManagerInterface $stageManager, TeamRepository $teamRepository, ManagerRegistry $doctrine) {
    $this->stageManager = $stageManager;
    $this->teamRepository = $teamRepository;
    $this->entityManager = $doctrine->getManager();
  }

}