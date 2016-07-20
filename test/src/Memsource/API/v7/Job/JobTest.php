<?php

use Memsource\API\v7\Job\Job;
use Memsource\Memsource;
use Memsource\Model\File;
use Memsource\Model\Parameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JobTest extends TestCase {

  const JOB_PART = 1;
  const PROJECT = 1;

  /** @var File */
  private $file;

  /** @var Job */
  private $job;

  /** @var Memsource */
  private $memsource;

  /** @var Parameters */
  private $parameters;

  public function setUp() {
    $this->file = new File();
    $this->file->path = $this->getTestFilePath();

    $this->memsource = new Memsource();
    $this->job = new Job($this->memsource);

    $this->parameters = new Parameters();
    $this->parameters->project = 1;
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

  /**
   * @test
   */
  public function getCompletedFileShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->job->getCompletedFile('incorrect-token', self::JOB_PART);

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function getJobShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->job->getJob('incorrect-token', self::JOB_PART);

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function listByProjectShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->job->listByProject('incorrect-token', self::PROJECT);

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }

  private function getTestFilePath() {
    return __DIR__ . '/test_job.html';
  }
}
