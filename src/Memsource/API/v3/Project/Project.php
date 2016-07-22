<?php

namespace Memsource\API\v3\Project;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Project extends BaseApi {

  const PATH_BASE = 'v3/project/';
  const PATH_GET = self::PATH_BASE . 'get';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @param string $token
   * @param int $project
   * @return JsonResponse
   */
  public function getProject($token, $project) {
    $parameters = new Parameters();
    $parameters->project = $project;
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_GET, $parameters);
  }

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function listProjects($token) {
    $parameters = new Parameters();
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_LIST, $parameters);
  }
}
