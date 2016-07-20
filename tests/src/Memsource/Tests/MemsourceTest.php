<?php

namespace Memsource\Tests;

use Memsource\Memsource;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MemsourceTest extends TestCase {

  /** @var Memsource */
  private $memsource;

  public function setUp() {
    $this->memsource = new Memsource();
  }

  /**
   * @test
   */
  public function loginShouldReturn401UnauthorizedResponseOnIncorrectCredentials() {
    $response = $this->memsource->login('userName', 'password');

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }
}
