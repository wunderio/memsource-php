<?php

use Memsource\API\v3\Project\Project;
use Memsource\Memsource;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProjectTest extends TestCase {

  const PROJECT = 1;

  /** @var Project */
  private $project;

  /** @var Memsource */
  private $memsource;

  public function setUp() {
    $this->memsource = new Memsource();
    $this->project = new Project($this->memsource);
  }

  /**
   * @test
   */
  public function getProjectShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->project->getProject('incorrect-token', self::PROJECT);

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function listProjectsShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->project->listProjects('incorrect-token');

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }
}
