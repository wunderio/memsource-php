<?php

namespace Memsource\Tests;

use Memsource\API\v3\Auth\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
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
  public function loginShouldReturn401UnauthorizedResponseOnIncorrectCredentials() {
    $response = $this->auth->login('incorrect-username', 'incorrect-password');

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function loginOtherShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->auth->loginOther(self::INCORRECT_TOKEN, 'token');

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function logoutShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->auth->logout(self::INCORRECT_TOKEN);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function whoAmIShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->auth->whoAmI(self::INCORRECT_TOKEN);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
