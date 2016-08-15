<?php

namespace Memsource\Tests;

use Memsource\API\v8\Job\Job;
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
  const TARGET_LANG = 'ja';
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
    $this->parameters->project = self::PROJECT;
    $this->parameters->targetLang = self::TARGET_LANG;
  }

  /**
   * @test
   */
  public function createShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->job->create($this->parameters, $this->file);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function getCompletedFileShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->job->getCompletedFile(self::JOB_PART);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function getJobShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->job->getJob(self::JOB_PART);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function listByProjectShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->job->listByProject(
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
  public function listJobsShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->job->listJobs(self::JOB_PART);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  private function getTestFilePath() {
    return __DIR__ . '/test_job.html';
  }
}
