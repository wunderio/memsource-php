<?php

namespace Memsource\API\v4\TranslationMemory;

use Memsource\API\BaseApi;
use Symfony\Component\HttpFoundation\JsonResponse;

class TranslationMemory extends BaseApi {

  const PATH_BASE = 'v4/transMemory/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @return JsonResponse
   */
  public function listTranslationMemories() {
    return $this->memsource->post(self::PATH_LIST);
  }
}