<?php

namespace Memsource\API\v2\Language;

use Memsource\Memsource;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Language {

  const PATH_BASE = '/web/api/v2/language/';
  const PATH_LIST_SUPPORTED_LANGUAGES = self::PATH_BASE . 'listSupportedLangs';

  /** @var Memsource */
  private $memsource;

  /**
   * @param Memsource $memsource
   */
  public function __construct(Memsource $memsource) {
    $this->memsource = $memsource;
  }

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function listSupportedLanguages($token) {
    $parameters = new Parameters();
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_LIST_SUPPORTED_LANGUAGES, $parameters);
  }
}
