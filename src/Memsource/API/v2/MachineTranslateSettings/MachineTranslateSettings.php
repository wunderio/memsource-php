<?php

namespace Memsource\API\v2\MachineTranslateSettings;

use Memsource\API\BaseApi;
use Symfony\Component\HttpFoundation\JsonResponse;

class MachineTranslateSettings extends BaseApi {

  const PATH_BASE = 'v2/machineTranslateSettings/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @return JsonResponse
   */
  public function listMachineTranslateSettings() {
    return $this->memsource->post(self::PATH_LIST);
  }
}
