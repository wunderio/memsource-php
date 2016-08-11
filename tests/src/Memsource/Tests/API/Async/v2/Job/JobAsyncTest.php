<?php

namespace Memsource\Tests;

use GuzzleHttp\Promise\PromiseInterface;
use Memsource\API\Async\v2\Job\JobAsync;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;

class JobAsyncTest extends MemsourceTestCase {

  const CALLBACK_URL = 'http://www.example.com/callback';
  const PROJECT = 1;
  const TARGET_LANG = 'ja';

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
    $this->parameters->callbackUrl = self::CALLBACK_URL;
    $this->parameters->project = self::PROJECT;
    $this->parameters->targetLang = self::TARGET_LANG;
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
