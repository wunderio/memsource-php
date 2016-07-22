<?php

namespace Memsource\API\v2\User;

use Memsource\API\BaseApi;
use Symfony\Component\HttpFoundation\JsonResponse;

class User extends BaseApi {

  const PATH_BASE = 'v2/user/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @return JsonResponse
   */
  public function listUsers() {
    return $this->memsource->post(self::PATH_LIST);
  }
}
