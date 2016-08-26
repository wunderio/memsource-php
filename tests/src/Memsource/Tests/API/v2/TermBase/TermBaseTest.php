<?php

namespace Memsource\Tests;

use Memsource\API\v2\TermBase\TermBase;
use Symfony\Component\HttpFoundation\Response;

class TermBaseTest extends MemsourceTestCase {

  const TERM_BASE = 1;

  /** @var TermBase */
  private $termBase;

  public function setUp() {
    parent::setUp();
    $this->termBase = new TermBase($this->memsource);
  }

  /**
   * @test
   */
  public function getTermBaseShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->termBase->getTermBase(self::TERM_BASE);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function listTermBasesShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->termBase->listTermBases();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
