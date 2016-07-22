<?php

namespace Memsource\Tests;

use Memsource\API\v2\WorkflowStep\WorkflowStep;
use Symfony\Component\HttpFoundation\Response;

class WorkflowStepTest extends MemsourceTestCase {

  const PROJECT = 1;

  /** @var WorkflowStep */
  private $workflowStep;

  public function setUp() {
    parent::setUp();
    $this->workflowStep = new WorkflowStep($this->memsource);
  }

  /**
   * @test
   */
  public function listWorkflowStepsShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->workflowStep->listWorkflowSteps(self::INVALID_TOKEN);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
