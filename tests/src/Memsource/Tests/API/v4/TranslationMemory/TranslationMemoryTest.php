<?php

namespace Memsource\Tests;

use Memsource\API\v4\TranslationMemory\TranslationMemory;
use Symfony\Component\HttpFoundation\Response;

class TranslationMemoryTest extends MemsourceTestCase {

  /** @var TranslationMemory */
  private $translationMemory;

  public function setUp() {
    parent::setUp();
    $this->translationMemory = new TranslationMemory($this->memsource);
  }

  /**
   * @test
   */
  public function listProjectsShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->translationMemory->listTranslationMemories();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
