<?php

use Memsource\Memsource;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class MemsourceTest extends TestCase {

  /** @var Memsource */
  private $memsource;

  public function setUp() {
    $this->memsource = new Memsource('https://cloud.memsource.com/');
  }

  /**
   * @test
   */
  public function loginShouldReturnJsonResponse() {
    $response = $this->memsource->login('userName', 'password');

    $this->assertInstanceOf(JsonResponse::class, $response);
  }
}
