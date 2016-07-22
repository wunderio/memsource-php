<?php

namespace Memsource\API\v2\BusinessUnit;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class BusinessUnit extends BaseApi {

  const PATH_BASE = 'v2/businessUnit/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function listBusinessUnits($token) {
    $parameters = new Parameters();
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_LIST, $parameters);
  }
}
