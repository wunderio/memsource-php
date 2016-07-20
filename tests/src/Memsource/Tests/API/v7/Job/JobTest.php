<?php

namespace Memsource\Tests;

use Memsource\API\v7\Job\Job;
use Memsource\Model\File;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JobTest extends MemsourceTestCase {

  const JOB_PART = 1;
  const PROJECT = 1;

  /** @var File */
  private $file;

  /** @var Job */
  private $job;

  /** @var Parameters */
  private $parameters;

  public function setUp() {
    parent::setUp();
    $this->file = new File();
    $this->file->path = $this->getTestFilePath();

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
    $this->parameters->token = self::INCORRECT_TOKEN;

    $response = $this->job->create($this->parameters, $this->file);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function getCompletedFileShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->job->getCompletedFile(self::INCORRECT_TOKEN, self::JOB_PART);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function getJobShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->job->getJob(self::INCORRECT_TOKEN, self::JOB_PART);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function listByProjectShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->job->listByProject(self::INCORRECT_TOKEN, self::PROJECT);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function listJobsShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->job->listJobs(self::INCORRECT_TOKEN, self::JOB_PART);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  private function getTestFilePath() {
    return __DIR__ . '/test_job.html';
  }
}
