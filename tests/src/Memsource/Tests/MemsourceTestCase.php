<?php

namespace Memsource\Tests;

use Memsource\Memsource;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class MemsourceTestCase extends TestCase {

  const INCORRECT_TOKEN = 'incorrect-token';

  /** @var Memsource */
  protected $memsource;

  public function setUp() {
    $response = new JsonResponse(
      '{"errorCode":"AuthUnauthorized","errorDescription":"Unauthorized access."}',
      Response::HTTP_UNAUTHORIZED,
      [],
      TRUE
    );

    $this->memsource = $this->prophesize(Memsource::class);
    $this->memsource->post(Argument::any(), Argument::any(), Argument::any())->willReturn($response);
    $this->memsource = $this->memsource->reveal();
  }
}