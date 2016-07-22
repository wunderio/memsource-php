<?php

namespace Memsource\API\v2\User;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class User extends BaseApi {

  const PATH_BASE = 'v2/user/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function listUsers($token) {
    $parameters = new Parameters();
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_LIST, $parameters);
  }
}
