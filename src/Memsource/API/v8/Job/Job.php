<?php

namespace Memsource\API\v8\Job;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;

class Job extends BaseApi {

  const PATH_BASE = 'v8/job/';
  const PATH_CREATE = self::PATH_BASE . 'create';
  const PATH_GET_COMPLETED_FILE = self::PATH_BASE . 'getCompletedFile';
  const PATH_GET_JOB = self::PATH_BASE . 'get';
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
   * @param int $jobPart
   * @return JsonResponse
   */
  public function getCompletedFile($jobPart) {
    $parameters = new Parameters();
    $parameters->jobPart = $jobPart;

    return $this->memsource->post(self::PATH_GET_COMPLETED_FILE, $parameters);
  }

  /**
   * @param int $jobPart
   * @return JsonResponse
   */
  public function getJob($jobPart) {
    $parameters = new Parameters();
    $parameters->jobPart = $jobPart;

    return $this->memsource->post(self::PATH_GET_JOB, $parameters);
  }

  /**
   * @param int|null $page
   * @param int $project
   * @param int|null $workflowLevel
   * @param int|null $assignedTo
   * @param string|null $status @see JobFilter
   * @return JsonResponse
   */
  public function listByProject($page = NULL, $project, $workflowLevel = NULL, $assignedTo = NULL, $status = NULL) {
    $parameters = new Parameters();
    $parameters->page = $page;
    $parameters->project = $project;
    $parameters->workflowLevel = $workflowLevel;
    $parameters->assignedTo = $assignedTo;
    $parameters->status = $status;

    return $this->memsource->post(self::PATH_LIST_BY_PROJECT, $parameters);
  }

  /**
   * @param int $jobPart
   * @return JsonResponse
   */
  public function listJobs($jobPart) {
    $parameters = new Parameters();
    $parameters->jobPart = $jobPart;

    return $this->memsource->post(self::PATH_LIST_JOBS, $parameters);
  }
}
