<?php

namespace Memsource\Tests;

use Memsource\API\v3\Project\Project;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProjectTest extends MemsourceTestCase {

  const PROJECT = 1;

  /** @var Project */
  private $project;

  public function setUp() {
    parent::setUp();
    $this->project = new Project($this->memsource);
  }

  /**
   * @test
   */
  public function getProjectShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->project->getProject(self::INCORRECT_TOKEN, self::PROJECT);

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function listProjectsShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->project->listProjects(self::INCORRECT_TOKEN);

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }
}
