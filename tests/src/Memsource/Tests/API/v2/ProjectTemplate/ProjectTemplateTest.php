<?php

namespace Memsource\Tests;

use Memsource\API\v2\ProjectTemplate\ProjectTemplate;
use Symfony\Component\HttpFoundation\Response;

class ProjectTemplateTest extends MemsourceTestCase {

  /** @var ProjectTemplate */
  private $projectTemplate;

  public function setUp() {
    parent::setUp();
    $this->projectTemplate = new ProjectTemplate($this->memsource);
  }

  /**
   * @test
   */
  public function listTemplatesShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->projectTemplate->listTemplates();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
