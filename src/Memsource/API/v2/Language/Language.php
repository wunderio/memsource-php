<?php

namespace Memsource\API\v2\Language;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Language extends BaseApi {

  const PATH_BASE = 'v2/language/';
  const PATH_LIST_SUPPORTED_LANGUAGES = self::PATH_BASE . 'listSupportedLangs';

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
