<?php

use Memsource\API\v7\Job\Job;
use Memsource\Memsource;
use Memsource\Model\File;
use Memsource\Model\Parameters;
use Memsource\Model\Project;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JobTest extends TestCase {

  /** @var File */
  private $file;

  /** @var Job */
  private $job;

  /** @var Memsource */
  private $memsource;

  /** @var Parameters */
  private $parameters;

  /** @var Project */
  private $project;

  public function setUp() {
    $this->file = new File();
    $this->file->path = __DIR__ . '/test_job.html';

    $this->memsource = new Memsource('https://cloud.memsource.com/');
    $this->job = new Job($this->memsource);

    $this->project = new Project();
    $this->project->id = 1;

    $this->parameters = new Parameters();
    $this->parameters->project = $this->project->id;
    $this->parameters->targetLang = 'ja';
    $this->parameters->token = 'token';
  }

  /**
   * @test
   */
  public function createShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $this->parameters->token = 'incorrect-token';

    $response = $this->job->create($this->parameters, $this->file);

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }
}