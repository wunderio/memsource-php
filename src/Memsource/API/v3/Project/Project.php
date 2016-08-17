<?php

namespace Memsource\API\v3\Project;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Project extends BaseApi {

  const PATH_BASE = 'v3/project/';
  const PATH_CREATE_FROM_TEMPLATE = self::PATH_BASE . 'createFromTemplate';
  const PATH_DELETE = self::PATH_BASE . 'delete';
  const PATH_GET = self::PATH_BASE . 'get';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @param int $template
   * @param string $name
   * @param string|null $dateDue
   * @param string|null $note
   * @param string|null $sourceLang
   * @param string|null $targetLang
   * @param int|null $workflowStep
   * @return JsonResponse
   */
  public function createFromTemplate($template, $name, $dateDue = NULL, $note = NULL, $sourceLang = NULL, $targetLang = NULL, $workflowStep = NULL) {
    $parameters = new Parameters();
    $parameters->template = $template;
    $parameters->name = $name;
    $parameters->dateDue = $dateDue;
    $parameters->note = $note;
    $parameters->sourceLang = $sourceLang;
    $parameters->targetLang = $targetLang;
    $parameters->workflowStep = $workflowStep;

    return $this->memsource->post(self::PATH_CREATE_FROM_TEMPLATE, $parameters);
  }

  /**
   * @param int $project
   * @return JsonResponse
   */
  public function delete($project) {
    $parameters = new Parameters();
    $parameters->project = $project;

    return $this->memsource->post(self::PATH_DELETE, $parameters);
  }

  /**
   * @param int $project
   * @return JsonResponse
   */
  public function getProject($project) {
    $parameters = new Parameters();
    $parameters->project = $project;

    return $this->memsource->post(self::PATH_GET, $parameters);
  }

  /**
   * @return JsonResponse
   */
  public function listProjects() {
    return $this->memsource->post(self::PATH_LIST);
  }
}
