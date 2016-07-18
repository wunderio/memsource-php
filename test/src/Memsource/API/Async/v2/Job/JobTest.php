<?php

use Memsource\API\Async\v2\Job\Job;
use Memsource\API\Async\v2\Job\Parameters;
use Memsource\Memsource;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JobTest extends TestCase {

  /** @var Job */
  private $job;

  /** @var Memsource */
  private $memsource;

  public function setUp() {
    $this->memsource = new Memsource('https://cloud.memsource.com/');
    $this->job = new Job($this->memsource);
  }

  /**
   * @test
   */
  public function createShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $parameters = new Parameters();
    $parameters->token = 'incorrect-token';

    $response = $this->job->create($parameters);

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }
}