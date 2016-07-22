<?php

namespace Memsource\API\v2\Language;

use Memsource\API\BaseApi;
use Symfony\Component\HttpFoundation\JsonResponse;

class Language extends BaseApi {

  const PATH_BASE = 'v2/language/';
  const PATH_LIST_SUPPORTED_LANGUAGES = self::PATH_BASE . 'listSupportedLangs';

  /**
   * @return JsonResponse
   */
  public function listSupportedLanguages() {
    return $this->memsource->post(self::PATH_LIST_SUPPORTED_LANGUAGES);
  }
}
