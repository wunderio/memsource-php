<?php

namespace Memsource\API\v7\Job;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;

class Job extends BaseApi {

  const PATH_BASE = 'web/api/v7/job/';
  const PATH_CREATE = self::PATH_BASE . 'create';
  const PATH_GET_COMPLETED_FILE = self::PATH_BASE . 'getCompletedFile';
  const PATH_GET_JOB = self::PATH_BASE . 'getCompletedFile';
  const PATH_LIST_BY_PROJECT = self::PATH_BASE . 'listByProject';
  const PATH_LIST_JOBS = self::PATH_BASE . 'list';

  /**
   * @param Parameters $parameters
   * @param File $file
   * @return JsonResponse
   */
  public function create(Parameters $parameters, File $file) {
    return $this->memsource->post(self::PATH_CREATE, $parameters, $file);
  }

  /**
   * @param string $token
   * @param int $jobPart
   * @return JsonResponse
   */
  public function getCompletedFile($token, $jobPart) {
    $parameters = new Parameters();
    $parameters->token = $token;
    $parameters->jobPart = $jobPart;

    return $this->memsource->post(self::PATH_GET_COMPLETED_FILE, $parameters);
  }

  /**
   * @param string $token
   * @param int $jobPart
   * @return JsonResponse
   */
  public function getJob($token, $jobPart) {
    $parameters = new Parameters();
    $parameters->token = $token;
    $parameters->jobPart = $jobPart;

    return $this->memsource->post(self::PATH_GET_JOB, $parameters);
  }

  /**
   * @param string $token
   * @param int|null $page
   * @param int $project
   * @param int|null $workflowLevel
   * @param int|null $assignedTo
   * @param string|null $status @see JobFilter
   * @return JsonResponse
   */
  public function listByProject($token, $page = NULL, $project, $workflowLevel = NULL, $assignedTo = NULL, $status = NULL) {
    $parameters = new Parameters();
    $parameters->token = $token;
    $parameters->page = $page;
    $parameters->project = $project;
    $parameters->workflowLevel = $workflowLevel;
    $parameters->assignedTo = $assignedTo;
    $parameters->status = $status;

    return $this->memsource->post(self::PATH_LIST_BY_PROJECT, $parameters);
  }

  /**
   * @param string $token
   * @param int $jobPart
   * @return JsonResponse
   */
  public function listJobs($token, $jobPart) {
    $parameters = new Parameters();
    $parameters->token = $token;
    $parameters->jobPart = $jobPart;

    return $this->memsource->post(self::PATH_LIST_JOBS, $parameters);
  }
}
