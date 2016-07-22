<?php

namespace Memsource\API\v2\BusinessUnit;

use Memsource\API\BaseApi;
use Symfony\Component\HttpFoundation\JsonResponse;

class BusinessUnit extends BaseApi {

  const PATH_BASE = 'v2/businessUnit/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @return JsonResponse
   */
  public function listBusinessUnits() {
    return $this->memsource->post(self::PATH_LIST);
  }
}
