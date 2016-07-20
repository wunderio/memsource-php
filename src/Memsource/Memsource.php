<?php

namespace Memsource;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Memsource\API\v2\Language\Language;
use Memsource\API\v3\Auth\Auth;
use Memsource\API\v3\Project\Project;
use Memsource\API\v7\Job\Job;
use Memsource\Model\File;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Memsource implements MemsourceInterface {

  const DEFAULT_BASE_URL = 'https://cloud.memsource.com/';

  /** @var Auth */
  private $auth;

  /** @var string */
  private $baseUrl;

  /** @var Client */
  private $client;

  /** @var Job */
  private $job;

  /** @var Language */
  private $language;

  /** @var Project */
  private $project;

  /**
   * @param string $baseUrl
   * @param Client $client
   */
  public function __construct($baseUrl = self::DEFAULT_BASE_URL, Client $client = NULL) {
    $this->auth = $this->getAuthService();
    $this->baseUrl = $baseUrl;
    $this->client = isset($client) ? $client : $this->getHttpClient();
    $this->job = $this->getJobService();
    $this->language = $this->getLanguageService();
  }

  /**
   * @inheritdoc
   */
  public function createJob(Parameters $parameters, File $file) {
    return $this->job->create($parameters, $file);
  }

  /**
   * @inheritdoc
   */
  public function getJob($token, $jobPart) {
    return $this->job->getJob($token, $jobPart);
  }

  /**
   * @inheritdoc
   */
  public function getCompletedFile($token, $jobPart) {
    return $this->job->getCompletedFile($token, $jobPart);
  }

  /**
   * @inheritdoc
   */
  public function getProject($token, $project) {
    return $this->project->getProject($token, $project);
  }

  /**
   * @inheritdoc
   */
  public function listJobs($token, $jobPart) {
    return $this->job->listJobs($token, $jobPart);
  }

  /**
   * @inheritdoc
   */
  public function listJobsByProject($token, $page = NULL, $project, $workflowLevel = NULL, $assignedTo = NULL, $status = NULL) {
    return $this->job->listByProject($token, $page, $project, $workflowLevel, $assignedTo, $status);
  }

  /**
   * @inheritdoc
   */
  public function listProjects($token) {
    return $this->project->listProjects($token);
  }

  /**
   * @inheritdoc
   */
  public function listSupportedLanguages($token) {
    return $this->language->listSupportedLanguages($token);
  }

  /**
   * @inheritdoc
   */
  public function login($userName, $password) {
    return $this->auth->login($userName, $password);
  }

  /**
   * @inheritdoc
   */
  public function loginOther($token, $userName) {
    return $this->auth->loginOther($token, $userName);
  }

  /**
   * @inheritdoc
   */
  public function logout($token) {
    return $this->auth->logout($token);
  }

  /**
   * @inheritdoc
   */
  public function whoAmI($token) {
    return $this->auth->whoAmI($token);
  }

  /**
   * @param string $path
   * @param Parameters $parameters
   * @param File|NULL $file
   * @return JsonResponse
   */
  public function post($path, Parameters $parameters, File $file = NULL) {
    $options = $this->buildPostOptions($parameters, $file);

    try {
      $response = $this->client->post($this->baseUrl . $path, $options);
    } catch (ClientException $e) {
      $response = $e->getResponse();
    }

    return new JsonResponse($response->getBody(), $response->getStatusCode(), $response->getHeaders());
  }

  /**
   * @return Auth
   */
  protected function getAuthService() {
    return new Auth($this);
  }

  /**
   * @return Client
   */
  protected function getHttpClient() {
    $config = ['base_uri' => $this->baseUrl];

    return new Client($config);
  }

  /**
   * @return Job
   */
  protected function getJobService() {
    return new Job($this);
  }

  /**
   * @return Language
   */
  protected function getLanguageService() {
    return new Language($this);
  }

  /**
   * @param Parameters $parameters
   * @param File $file
   * @return array
   */
  private function buildPostOptions(Parameters $parameters, File $file = NULL) {
    if ($file) {
      $options = $this->buildMultipartPostOptions($parameters, $file);
    } else {
      $options = [RequestOptions::FORM_PARAMS => $parameters];
    }

    return $options;
  }

  /**
   * @param Parameters $parameters
   * @param File $file
   * @return array
   */
  private function buildMultipartPostOptions(Parameters $parameters, File $file) {
    $formParameters = [];

    $formParameters[] = [
      'name' => 'file',
      'contents' => fopen($file->path, 'r'),
      'filename' => basename($file->path),
    ];

    foreach ($parameters as $key => $value) {
      $formParameters[] = ['name' => $key, 'contents' => $value];
    }

    $options = [RequestOptions::MULTIPART => $formParameters];

    return $options;
  }
}
