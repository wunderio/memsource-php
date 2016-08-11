<?php

namespace Memsource\Tests;

use Memsource\API\v2\User\User;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends MemsourceTestCase {

  const USER = 1;
  const USER_NAME = 'userName';

  /** @var User */
  private $user;

  public function setUp() {
    parent::setUp();
    $this->user = new User($this->memsource);
  }

  /**
   * @test
   */
  public function getUserShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->user->getUser(self::USER);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function getByUserNameShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->user->getByUserName(self::USER_NAME);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function listUsersShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->user->listUsers();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
