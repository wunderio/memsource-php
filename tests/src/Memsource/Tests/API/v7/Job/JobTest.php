<?php

namespace Memsource\Tests;

use Memsource\API\v7\Job\Job;
use Memsource\Model\JobFilter;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;

class JobTest extends MemsourceTestCase {

  const ASSIGNED_TO = 1;
  const JOB_PART = 1;
  const PAGE = 1;
  const PROJECT = 1;
  const STATUS = JobFilter::STATUS_COMPLETED;
  const WORKFLOW_LEVEL = 1;

  /** @var File */
  private $file;

  /** @var Job */
  private $job;

  /** @var Parameters */
  private $parameters;

  public function setUp() {
    parent::setUp();
    $this->file = new File($this->getTestFilePath());

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
    $response = $this->job->listByProject(
      self::INCORRECT_TOKEN,
      self::PAGE,
      self::PROJECT,
      self::WORKFLOW_LEVEL,
      self::ASSIGNED_TO,
      self::STATUS
    );

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
