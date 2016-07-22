<?php

namespace Memsource\API\v2\User;

use Memsource\Memsource;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class User {

  const PATH_BASE = '/web/api/v2/user/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /** @var Memsource */
  private $memsource;

  /**
   * @param Memsource $memsource
   */
  public function __construct(Memsource $memsource) {
    $this->memsource = $memsource;
  }

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
