<?php

namespace Memsource\Tests;

use Memsource\API\v2\Language\Language;
use Symfony\Component\HttpFoundation\Response;

class LanguageTest extends MemsourceTestCase {

  const PROJECT = 1;

  /** @var Language */
  private $language;

  public function setUp() {
    parent::setUp();
    $this->language = new Language($this->memsource);
  }

  /**
   * @test
   */
  public function listSupportedLanguagesShouldReturn401UnauthorizedResponseOnIncorrectToken() {
    $response = $this->language->listSupportedLanguages(self::INCORRECT_TOKEN);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
