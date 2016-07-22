<?php

namespace Memsource\API\v2\WorkflowStep;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class WorkflowStep extends BaseApi {

  const PATH_BASE = 'v2/workflowStep/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function listWorkflowSteps($token) {
    $parameters = new Parameters();
    $parameters->token = $token;

    return $this->memsource->post(self::PATH_LIST, $parameters);
  }
}
