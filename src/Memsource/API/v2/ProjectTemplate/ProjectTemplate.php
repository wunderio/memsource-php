<?php

namespace Memsource\API\v2\ProjectTemplate;

use Memsource\API\BaseApi;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjectTemplate extends BaseApi {

  const PATH_BASE = 'v2/projectTemplate/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @return JsonResponse
   */
  public function listTemplates() {
    return $this->memsource->post(self::PATH_LIST);
  }
}
