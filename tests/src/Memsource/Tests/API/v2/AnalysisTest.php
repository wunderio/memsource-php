<?php

namespace Memsource\Tests;

use Memsource\API\v2\Analysis\Analysis;
use Symfony\Component\HttpFoundation\Response;

class AnalysisTest extends MemsourceTestCase {

  const PROJECT = 1;

  /** @var Analysis */
  private $analysis;

  public function setUp() {
    parent::setUp();
    $this->analysis = new Analysis($this->memsource);
  }

  /**
   * @test
   */
  public function listByProjectShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->analysis->listByProject(self::INCORRECT_TOKEN, self::PROJECT);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
