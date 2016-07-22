<?php

namespace Memsource\API\v2\Analysis;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Analysis extends BaseApi {

  const PATH_BASE = 'v2/analyse/';
  const PATH_LIST_BY_PROJECT = self::PATH_BASE . 'listByProject';

  /**
   * @param int $project
   * @return JsonResponse
   */
  public function listByProject($project) {
    $parameters = new Parameters();
    $parameters->project = $project;

    return $this->memsource->post(self::PATH_LIST_BY_PROJECT, $parameters);
  }
}
