<?php

namespace Memsource\Tests;

use Memsource\API\v2\User\User;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends MemsourceTestCase {

  const PROJECT = 1;

  /** @var User */
  private $user;

  public function setUp() {
    parent::setUp();
    $this->user = new User($this->memsource);
  }

  /**
   * @test
   */
  public function listUsersShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->user->listUsers();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
