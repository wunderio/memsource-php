<?php

namespace Memsource;

use Symfony\Component\HttpFoundation\JsonResponse;

interface MemsourceInterface {

  /**
   * @param $userName string User name.
   * @param $password string Password.
   * @return JsonResponse
   */
  public function login($userName, $password);

  /**
   * @param $token string Token.
   * @param $userName string User name.
   * @return JsonResponse
   */
  public function loginOther($token, $userName);

  /**
   * @param $token string Token.
   * @return JsonResponse
   */
  public function logout($token);

  /**
   * @param $token string Token.
   * @return JsonResponse
   */
  public function whoAmI($token);
}
