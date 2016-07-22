<?php

namespace Memsource\API\v2\Domain;

use Memsource\API\BaseApi;
use Symfony\Component\HttpFoundation\JsonResponse;

class Domain extends BaseApi {

  const PATH_BASE = 'v2/domain/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @return JsonResponse
   */
  public function listDomains() {
    return $this->memsource->post(self::PATH_LIST);
  }
}
