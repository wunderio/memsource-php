<?php

namespace Memsource\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use Memsource\Memsource;
use Memsource\Model\Parameters;
use Prophecy\Argument;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MemsourceTest extends MemsourceTestCase {

  const PASSWORD = 'password';
  const PATH = 'http://www.example.com/path';
  const USER_NAME = 'userName';

  /** @var Client */
  private $client;

  /** @var RequestInterface */
  private $request;

  /** @var ResponseInterface */
  private $response;

  public function setUp() {
    $this->request = new \GuzzleHttp\Psr7\Request('POST', self::PATH, [], 'body');
    $this->response = new \GuzzleHttp\Psr7\Response(Response::HTTP_UNAUTHORIZED);

    $this->client = $this->prophesize(Client::class);
    $this->client->post(Argument::any(), Argument::any())->willReturn($this->response);
    $this->client->postAsync(Argument::any(), Argument::any())->willReturn(new Promise());

    $this->memsource = new Memsource(
      self::USER_NAME,
      self::PASSWORD,
      self::INVALID_TOKEN,
      self::MEMSOURCE_TEST_BASE_URL,
      $this->client->reveal()
    );
  }

  /**
   * @test
   */
  public function loginShouldReturn401UnauthorizedResponseOnInvalidCredentials() {
    $response = $this->memsource->login(self::USER_NAME, self::PASSWORD);

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
  public function postShouldHandleClientExceptionGracefully() {
    $exception = new ClientException('message', $this->request, $this->response);
    $this->client->post(Argument::any(), Argument::any())->willThrow($exception);

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

  /**
   * @test
   */
  public function shouldThrowAnExceptionOnConstructionWhenRetrievingTheTokenFails() {
    $this->expectException(\Exception::class);

    new Memsource(
      self::USER_NAME,
      self::PASSWORD,
      NULL,
      self::MEMSOURCE_TEST_BASE_URL,
      $this->client->reveal()
    );
  }
}
