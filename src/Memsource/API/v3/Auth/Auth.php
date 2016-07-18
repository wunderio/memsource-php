<?php

namespace Memsource\API\v3\Auth;

use Memsource\Memsource;
use Symfony\Component\HttpFoundation\JsonResponse;

class Auth {

  const PATH_BASE = '/web/api/v3/auth/';
  const PATH_LOGIN = self::PATH_BASE . 'login';
  const PATH_LOGIN_OTHER = self::PATH_BASE . 'loginOther';
  const PATH_LOGOUT = self::PATH_BASE . 'logout';
  const PATH_WHO_AM_I = self::PATH_BASE . 'whoAmI';

  /** @var Memsource */
  private $memsource;

  public function __construct(Memsource $memsource) {
    $this->memsource = $memsource;
  }

  /**
   * @param $userName string User name.
   * @param $password string Password.
   * @return JsonResponse
   */
  public function login($userName, $password) {
    return $this->memsource->post(self::PATH_LOGIN, ['userName' => $userName, 'password' => $password]);
  }

  /**
   * @param $token string Token.
   * @param $userName string User name.
   * @return JsonResponse
   */
  public function loginOther($token, $userName) {
    return $this->memsource->post(self::PATH_LOGIN_OTHER, ['token' => $token, 'userName' => $userName]);
  }

  /**
   * @param $token string Token.
   * @return JsonResponse
   */
  public function logout($token) {
    return $this->memsource->post(self::PATH_LOGOUT, ['token' => $token]);
  }

  /**
   * @param $token string Token.
   * @return JsonResponse
   */
  public function whoAmI($token) {
    return $this->memsource->post(self::PATH_WHO_AM_I, ['token' => $token]);
  }
}
