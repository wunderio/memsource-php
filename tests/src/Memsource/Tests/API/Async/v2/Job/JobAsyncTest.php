<?php

namespace Memsource\Tests;

use GuzzleHttp\Promise\PromiseInterface;
use Memsource\API\Async\v2\Job\JobAsync;
use Memsource\Model\JobFilter;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;

class JobAsyncTest extends MemsourceTestCase {

  const ASSIGNED_TO = 1;
  const CALLBACK_URL = 'http://www.example.com/callback';
  const JOB_PART = 1;
  const PAGE = 1;
  const PROJECT = 1;
  const STATUS = JobFilter::STATUS_COMPLETED;
  const WORKFLOW_LEVEL = 1;

  /** @var File */
  private $file;

  /** @var JobAsync */
  private $jobAsync;

  /** @var Parameters */
  private $parameters;

  public function setUp() {
    parent::setUp();
    $this->file = new File($this->getTestFilePath());

    $this->jobAsync = new JobAsync($this->memsource);

    $this->parameters = new Parameters();
    $this->parameters->project = 1;
    $this->parameters->targetLang = 'ja';
    $this->parameters->callbackUrl = self::CALLBACK_URL;
  }

  /**
   * @test
   */
  public function createShouldReturnPromise() {
    $response = $this->jobAsync->create($this->parameters, $this->file);

    $this->assertInstanceOf(PromiseInterface::class, $response);
  }

  private function getTestFilePath() {
    return __DIR__ . '/test_job.html';
  }
}
