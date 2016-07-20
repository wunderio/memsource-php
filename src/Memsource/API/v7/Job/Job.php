<?php

namespace Memsource\API\v7\Job;

use Memsource\Memsource;
use Memsource\Model\File;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Job {

  const PATH_BASE = 'web/api/v7/job/';
  const PATH_CREATE = self::PATH_BASE . 'create';
  const PATH_GET_COMPLETED_FILE = self::PATH_BASE . 'getCompletedFile';
  const PATH_GET_JOB = self::PATH_BASE . 'getCompletedFile';
  const PATH_LIST_BY_PROJECT = self::PATH_BASE . 'listByProject';

  /** @var Memsource */
  private $memsource;

  /**
   * @param Memsource $memsource
   */
  public function __construct(Memsource $memsource) {
    $this->memsource = $memsource;
  }

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
   * @param int $project
   * @return JsonResponse
   */
  public function listByProject($token, $project) {
    $parameters = new Parameters();
    $parameters->token = $token;
    $parameters->project = $project;

    return $this->memsource->post(self::PATH_LIST_BY_PROJECT, $parameters);
  }
}
