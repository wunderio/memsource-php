<?php

namespace Memsource\Tests;

use Memsource\API\v2\BusinessUnit\BusinessUnit;
use Symfony\Component\HttpFoundation\Response;

class BusinessUnitTest extends MemsourceTestCase {

  /** @var BusinessUnit */
  private $businessUnit;

  public function setUp() {
    parent::setUp();
    $this->businessUnit = new BusinessUnit($this->memsource);
  }

  /**
   * @test
   */
  public function listBusinessUnitsShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->businessUnit->listBusinessUnits();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
