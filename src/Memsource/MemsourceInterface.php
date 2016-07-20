<?php

namespace Memsource;

use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;

interface MemsourceInterface {

  /**
   * @param Parameters $parameters
   * @param File $file
   * @return JsonResponse
   */
  public function createJob(Parameters $parameters, File $file);

  /**
   * @param string $token
   * @param int $jobPart
   * @return JsonResponse
   */
  public function getCompletedFile($token, $jobPart);

  /**
   * @param $token
   * @param $jobPart
   * @return JsonResponse
   */
  public function getJob($token, $jobPart);

  /**
   * @param string $token
   * @param int $project
   * @return JsonResponse
   */
  public function getProject($token, $project);

  /**
   * @param string $token
   * @param int $jobPart
   * @return JsonResponse
   */
  public function listJobs($token, $jobPart);

  /**
   * @param string $token
   * @param int|null $page
   * @param int $project
   * @param int|null $workflowLevel
   * @param int|null $assignedTo
   * @param string|null $status @see JobFilter
   * @return JsonResponse
   */
  public function listJobsByProject($token, $page = NULL, $project, $workflowLevel = NULL, $assignedTo = NULL, $status = NULL);

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function listProjects($token);

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function listSupportedLanguages($token);

  /**
   * @param string $userName
   * @param string $password
   * @return JsonResponse
   */
  public function login($userName, $password);

  /**
   * @param string $token
   * @param string $userName
   * @return JsonResponse
   */
  public function loginOther($token, $userName);

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function logout($token);

  /**
   * @param string $token
   * @return JsonResponse
   */
  public function whoAmI($token);
}
