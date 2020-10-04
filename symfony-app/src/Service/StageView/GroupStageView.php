<?php

namespace App\Service\StageView;

use App\Repository\DivisionRepository;
use App\Repository\TeamRepository;
use App\Service\StageManager\GroupStageManagerInterface;

class GroupStageView extends StageViewBase {

  /**
   * @var \App\Repository\DivisionRepository
   */
  protected DivisionRepository $divisionRepository;

  /**
   * @var \App\Repository\TeamRepository
   */
  protected TeamRepository $teamRepository;

  public function __construct(GroupStageManagerInterface $stageManager, DivisionRepository $divisionRepository, TeamRepository $teamRepository) {
    parent::__construct($stageManager);

    $this->divisionRepository = $divisionRepository;
    $this->teamRepository = $teamRepository;
  }

  /**
   * @inheritdoc
   */
  public function prepareVariablesForTemplate(): array {
    $groupedResults = $this->stageManager->generateResultsMatrix();

    $teamScores = $this->stageManager->calculateTeamScores();

    $groupedTeams = [];
    foreach($this->teamRepository->findAll() as $team) {
      $groupedTeams[$team->getDivision()->getId()][] = $team;
    }

    return [
      'grouped_results' => $groupedResults,
      'team_scores' => $teamScores,
      'divisions' => $this->divisionRepository->findAll(),
      'grouped_teams' => $groupedTeams,
    ];
  }

  public function getTemplatePath(): string {
    return 'stage/group.html.twig';
  }

}
