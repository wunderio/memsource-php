<?php

namespace Memsource\API\v2\WorkflowStep;

use Memsource\API\BaseApi;
use Symfony\Component\HttpFoundation\JsonResponse;

class WorkflowStep extends BaseApi {

  const PATH_BASE = 'v2/workflowStep/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @return JsonResponse
   */
  public function listWorkflowSteps() {
    return $this->memsource->post(self::PATH_LIST);
  }
}
