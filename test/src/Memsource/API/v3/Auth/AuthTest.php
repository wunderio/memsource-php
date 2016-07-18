<?php

use Memsource\API\v3\Auth\Auth;
use Memsource\Memsource;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthTest extends TestCase {

  /** @var Auth */
  private $auth;

  /** @var Memsource */
  private $memsource;

  public function setUp() {
    $this->memsource = new Memsource('https://cloud.memsource.com/');
    $this->auth = new Auth($this->memsource);
  }

  /**
   * @test
   */
  public function loginShouldReturn401UnauthorizedResponseOnIncorrectCredentials() {
    $response = $this->auth->login('incorrect-username', 'incorrect-password');

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function loginOtherShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->auth->loginOther('incorrect-token', 'token');

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function logoutShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->auth->logout('incorrect-token');

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }

  /**
   * @test
   */
  public function whoAmIShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->auth->whoAmI('incorrect-token');

    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
  }
}
