<?php

namespace Memsource\API\v2\Domain;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Domain extends BaseApi {

  const PATH_BASE = 'v2/domain/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function listDomains($token) {
    $parameters = new Parameters();
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_LIST, $parameters);
  }
}
