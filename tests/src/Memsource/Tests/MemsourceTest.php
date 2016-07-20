<?php

namespace Memsource\Tests;

use GuzzleHttp\Client;
use Memsource\Memsource;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MemsourceTest extends MemsourceTestCase {

  /** @var Client */
  private $client;

  /** @var ResponseInterface */
  private $response;

  public function setUp() {
    $this->response = new \GuzzleHttp\Psr7\Response(Response::HTTP_UNAUTHORIZED);

    $this->client = $this->prophesize(Client::class);
    $this->client->post(Argument::any(), Argument::any())->willReturn($this->response);

    $this->memsource = new Memsource(self::MEMSOURCE_TEST_BASE_URL, $this->client->reveal());
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
