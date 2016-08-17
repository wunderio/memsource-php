<?php

namespace Memsource\Tests;

use Memsource\API\v3\Project\Project;
use Symfony\Component\HttpFoundation\Response;

class ProjectTest extends MemsourceTestCase {

  const NAME = 'name';
  const PROJECT = 1;
  const TEMPLATE = 1;

  /** @var Project */
  private $project;

  public function setUp() {
    parent::setUp();
    $this->project = new Project($this->memsource);
  }

  /**
   * @test
   */
  public function createFromTemplateShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->project->createFromTemplate(self::TEMPLATE, self::NAME);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function deleteShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->project->delete(self::PROJECT);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function getProjectShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->project->getProject(self::PROJECT);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function listProjectsShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->project->listProjects();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
