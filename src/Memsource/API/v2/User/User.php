<?php

namespace Memsource\API\v2\User;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class User extends BaseApi {

  const PATH_BASE = 'v2/user/';
  const PATH_GET_BY_USER_NAME = self::PATH_BASE . 'getByUserName';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @return JsonResponse
   */
  public function listUsers() {
    return $this->memsource->post(self::PATH_LIST);
  }

  /**
   * @param string $userName
   * @return JsonResponse
   */
  public function getByUserName($userName) {
    $parameters = new Parameters();
    $parameters->userName = $userName;

    return $this->memsource->post(self::PATH_GET_BY_USER_NAME, $parameters);
  }
}
