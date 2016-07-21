<?php

namespace Memsource\API\v3\Auth;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Auth extends BaseApi {

  const PATH_BASE = '/web/api/v3/auth/';
  const PATH_LOGIN = self::PATH_BASE . 'login';
  const PATH_LOGIN_OTHER = self::PATH_BASE . 'loginOther';
  const PATH_LOGOUT = self::PATH_BASE . 'logout';
  const PATH_WHO_AM_I = self::PATH_BASE . 'whoAmI';

  /**
   * @param string $userName
   * @param string $password
   * @return JsonResponse
   */
  public function login($userName, $password) {
    $parameters = new Parameters();
    $parameters->userName = $userName;
    $parameters->password = $password;

    return $this->memsource->post(self::PATH_LOGIN, $parameters);
  }

  /**
   * @param string $token
   * @param string $userName
   * @return JsonResponse
   */
  public function loginOther($token, $userName) {
    $parameters = new Parameters();
    $parameters->token = $token;
    $parameters->userName = $userName;

    return $this->memsource->post(self::PATH_LOGIN_OTHER, $parameters);
  }

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function logout($token) {
    $parameters = new Parameters();
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_LOGOUT, $parameters);
  }

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function whoAmI($token) {
    $parameters = new Parameters();
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_WHO_AM_I, $parameters);
  }
}
