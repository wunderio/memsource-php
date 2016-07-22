<?php

namespace Memsource\Tests;

use Memsource\API\v3\Auth\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthTest extends MemsourceTestCase {

  /** @var Auth */
  private $auth;

  public function setUp() {
    parent::setUp();
    $this->auth = new Auth($this->memsource);
  }

  /**
   * @test
   */
  public function loginShouldReturn401UnauthorizedResponseOnInvalidCredentials() {
    $response = $this->auth->login('invalid-username', 'invalid-password');

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function loginOtherShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->auth->loginOther(self::INVALID_TOKEN, 'token');

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function logoutShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->auth->logout(self::INVALID_TOKEN);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function whoAmIShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->auth->whoAmI(self::INVALID_TOKEN);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
