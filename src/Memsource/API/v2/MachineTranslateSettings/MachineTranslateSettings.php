<?php

namespace Memsource\API\v2\MachineTranslateSettings;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class MachineTranslateSettings extends BaseApi {

  const PATH_BASE = '/web/api/v2/machineTranslateSettings/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function listMachineTranslateSettings($token) {
    $parameters = new Parameters();
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_LIST, $parameters);
  }
}
