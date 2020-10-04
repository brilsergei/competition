<?php

namespace App\Service;

use App\Repository\GameResultRepository;
use App\Repository\TeamRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class StageFabricBase implements StageFabricInterface {

  /**
   * @var \Doctrine\Persistence\ManagerRegistry
   */
  protected ManagerRegistry $doctrine;

  protected GameResultRepository $gameResultRepository;

  protected TeamRepository $teamRepository;

  public function __construct(ManagerRegistry $doctrine, GameResultRepository $repository, TeamRepository $teamRepository) {
    $this->gameResultRepository = $repository;
    $this->teamRepository = $teamRepository;
    $this->doctrine = $doctrine;
  }

}