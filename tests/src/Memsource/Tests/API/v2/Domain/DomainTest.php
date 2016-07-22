<?php

namespace Memsource\Tests;

use Memsource\API\v2\Domain\Domain;
use Symfony\Component\HttpFoundation\Response;

class DomainTest extends MemsourceTestCase {

  const PROJECT = 1;

  /** @var Domain */
  private $domain;

  public function setUp() {
    parent::setUp();
    $this->domain = new Domain($this->memsource);
  }

  /**
   * @test
   */
  public function listDomainsShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->domain->listDomains();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
