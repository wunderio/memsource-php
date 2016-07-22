<?php

namespace Memsource\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use Memsource\Memsource;
use Memsource\Model\Parameters;
use Prophecy\Argument;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MemsourceTest extends MemsourceTestCase {

  const PATH = 'http://www.example.com/path';

  /** @var Client */
  private $client;

  /** @var ResponseInterface */
  private $response;

  public function setUp() {
    $this->response = new \GuzzleHttp\Psr7\Response(Response::HTTP_UNAUTHORIZED);

    $this->client = $this->prophesize(Client::class);
    $this->client->post(Argument::any(), Argument::any())->willReturn($this->response);
    $this->client->postAsync(Argument::any(), Argument::any())->willReturn(new Promise());

    $this->memsource = new Memsource(self::MEMSOURCE_TEST_BASE_URL, $this->client->reveal());
  }

  /**
   * @test
   */
  public function loginShouldReturn401UnauthorizedResponseOnInvalidCredentials() {
    $response = $this->memsource->login('userName', 'password');

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function postShouldReturnJsonResponse() {
    $response = $this->memsource->post(self::PATH, new Parameters());

    $this->assertInstanceOf(JsonResponse::class, $response);
  }

  /**
   * @test
   */
  public function postAsyncShouldReturnPromise() {
    $response = $this->memsource->postAsync(self::PATH, new Parameters());

    $this->assertInstanceOf(PromiseInterface::class, $response);
  }
}
