<?php

namespace Memsource;

use Memsource\Model\File;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

interface MemsourceInterface {

  /**
   * @param Parameters $parameters
   * @param File $file
   * @return JsonResponse
   */
  public function createJob(Parameters $parameters, File $file);

  /**
   * @param string $userName
   * @param string $password
   * @return JsonResponse
   */
  public function login($userName, $password);

  /**
   * @param string $token
   * @param string $userName
   * @return JsonResponse
   */
  public function loginOther($token, $userName);

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function logout($token);

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function whoAmI($token);
}
